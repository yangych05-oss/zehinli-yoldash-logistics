<?php

namespace App\Support;

use App\Models\SiteCopyOverride;
use App\Models\SiteMediaItem;
use Illuminate\Support\Facades\Schema;

final class CmsContent
{
    private const PAGES = ['home', 'about', 'services', 'contact', 'tracking'];
    private const LOCALES = ['ru', 'tm', 'en'];

    /**
     * Overlays published text keys onto the existing Blade fallback.
     * Missing tables, records, or invalid keys must never take the public site down.
     *
     * @param array<string, mixed> $defaults
     * @return array<string, mixed>
     */
    public static function copy(string $page, string $locale, array $defaults): array
    {
        if (!in_array($page, self::PAGES, true) || !in_array($locale, self::LOCALES, true)) {
            return $defaults;
        }

        try {
            if (!Schema::hasTable('site_copy_overrides')) {
                return $defaults;
            }
            $rows = SiteCopyOverride::query()
                ->where('page', $page)
                ->where('locale', $locale)
                ->where('is_published', true)
                ->get(['content_key', 'value']);
            foreach ($rows as $row) {
                $key = (string) $row->content_key;
                // No arbitrary new keys, markup, or structural array overrides.
                if (!preg_match('/^[a-z][a-z0-9_]*(?:\.[a-z0-9_]+)*$/D', $key)) {
                    continue;
                }
                $fallback = data_get($defaults, $key);
                if (!is_string($fallback) || trim($row->value) === '') {
                    continue;
                }
                data_set($defaults, $key, $row->value);
            }
        } catch (\Throwable $error) {
            report($error);
        }
        return $defaults;
    }

    /**
     * Returns published media overrides indexed by their numbered gallery slot.
     * Do not delete source files when unpublishing: retain rollback capability.
     *
     * @return array<int, array{file_path:string, poster_path:?string, caption:string}>
     */
    public static function media(string $kind, string $locale, string $collection = 'home-gallery'): array
    {
        if (!in_array($kind, ['image', 'video'], true) || !in_array($locale, self::LOCALES, true)) {
            return [];
        }

        try {
            if (!Schema::hasTable('site_media_items')) {
                return [];
            }
            $items = SiteMediaItem::query()
                ->where('collection', $collection)
                ->where('kind', $kind)
                ->where('is_published', true)
                ->orderBy('slot')
                ->get();

            $result = [];
            foreach ($items as $item) {
                $file = (string) $item->file_path;
                if (!self::safeMediaPath($file, $kind)) {
                    continue;
                }
                $slot = (int) $item->slot;
                if ($slot < 0 || $slot > 200) {
                    continue;
                }
                $poster = $item->poster_path;
                if ($poster !== null && !self::safeMediaPath((string) $poster, 'image')) {
                    $poster = null;
                }
                // Laravel public disk files are served via the /storage symlink.
                if (str_starts_with($file, 'cms/media/')) {
                    $file = 'storage/'.$file;
                }
                if ($poster !== null && str_starts_with($poster, 'cms/media/')) {
                    $poster = 'storage/'.$poster;
                }
                $result[$slot] = [
                    'file_path' => $file,
                    'poster_path' => $poster,
                    'caption' => (string) ($item->{'caption_'.$locale} ?: $item->caption_en ?: ''),
                ];
            }
            return $result;
        } catch (\Throwable $error) {
            report($error);
            return [];
        }
    }
    /**
     * Restrict database paths to known public media roots, safe path segments
     * and expected file extensions. Never allow traversal, PHP or URLs.
     */
    private static function safeMediaPath(string $path, string $kind): bool
    {
        $ext = $kind === 'video' ? '(?:mp4|webm)' : '(?:jpg|jpeg|png|webp)';

        return preg_match(
            '#\A(?:cms/media/|media/zny/2026/)(?:[A-Za-z0-9_-]+/)*[A-Za-z0-9_-]+\.'.$ext.'\z#iD',
            $path,
        ) === 1;
    }

}
