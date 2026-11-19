<?php
declare(strict_types=1);

/**
 * Standalone contract tests for CMS content handling.
 * Runs without Composer or the live database; no production writes.
 */
namespace Illuminate\Support\Facades {
    final class Schema
    {
        public static array $available = [
            'site_copy_overrides' => true,
            'site_media_items' => true,
        ];

        public static function hasTable(string $name): bool
        {
            return self::$available[$name] ?? false;
        }
    }
}

namespace App\Models {
    final class FakeQuery
    {
        private array $constraints = [];
        private ?string $orderField = null;

        public function __construct(private array $rows) {}

        public function where(string $key, mixed $value): self
        {
            $this->constraints[$key] = $value;
            return $this;
        }

        public function orderBy(string $key): self
        {
            $this->orderField = $key;
            return $this;
        }

        public function get(array $columns = []): array
        {
            $rows = array_filter($this->rows, function (array $row): bool {
                foreach ($this->constraints as $key => $value) {
                    if (($row[$key] ?? null) !== $value) {
                        return false;
                    }
                }
                return true;
            });
            if ($this->orderField !== null) {
                $field = $this->orderField;
                usort($rows, fn (array $a, array $b): int => ($a[$field] ?? 0) <=> ($b[$field] ?? 0));
            }
            return array_map(static fn (array $row): object => (object) $row, $rows);
        }
    }

    final class SiteCopyOverride
    {
        public static array $rows = [];

        public static function query(): FakeQuery
        {
            return new FakeQuery(self::$rows);
        }
    }

    final class SiteMediaItem
    {
        public static array $rows = [];

        public static function query(): FakeQuery
        {
            return new FakeQuery(self::$rows);
        }
    }
}

namespace {
    use App\Models\SiteCopyOverride;
    use App\Models\SiteMediaItem;
    use App\Support\CmsContent;
    use Illuminate\Support\Facades\Schema;

    function data_get(array $target, string $key): mixed
    {
        foreach (explode('.', $key) as $part) {
            if (!is_array($target) || !array_key_exists($part, $target)) {
                return null;
            }
            $target = $target[$part];
        }
        return $target;
    }

    function data_set(array &$target, string $key, mixed $value): void
    {
        $path = explode('.', $key);
        $node = &$target;
        foreach ($path as $part) {
            if (!isset($node[$part]) || !is_array($node[$part])) {
                if ($part !== end($path)) {
                    $node[$part] = [];
                }
            }
            $node = &$node[$part];
        }
        $node = $value;
    }

    function report(\Throwable $error): void
    {
        $GLOBALS['cms_test_errors'][] = $error->getMessage();
    }

    require dirname(__DIR__).'/app/Support/CmsFieldCatalog.php';
    require dirname(__DIR__).'/app/Support/CmsMediaCatalog.php';
    require dirname(__DIR__).'/app/Support/CmsContent.php';

    $passed = 0;
    function verify(string $label, bool $condition): void
    {
        global $passed;
        if (!$condition) {
            fwrite(STDERR, "FAIL: ".$label.PHP_EOL);
            exit(1);
        }
        $passed++;
        echo "PASS: ".$label.PHP_EOL;
    }

    verify('Catalog exposes home hero title', \App\Support\CmsFieldCatalog::contains('home','hero_title'));
    verify('Catalog exposes nested service copy', \App\Support\CmsFieldCatalog::contains('home','services.3.text'));
    verify('Catalog excludes image URL overrides', !\App\Support\CmsFieldCatalog::contains('home','services.0.image'));
    verify('Catalog excludes unknown nested keys', !\App\Support\CmsFieldCatalog::contains('about','pillars.4.title'));

    verify('Page photo slots have a localized section catalogue', \App\Support\CmsMediaCatalog::allows('page-home','image',4));
    verify('Page media catalog blocks wrong video locations', !\App\Support\CmsMediaCatalog::allows('page-about','video',0));
    verify('Gallery accepts additional photo positions', \App\Support\CmsMediaCatalog::allows('home-gallery','image',10));
    verify('Unexpected photo positions are blocked', !\App\Support\CmsMediaCatalog::allows('page-contact','image',15));
    $defaults = [
        'hero_title' => 'Original RU headline',
        'hero_text' => 'Original copy',
        'value_points' => ['First', 'Second'],
        'array_block' => ['this' => 'stays'],
    ];

    Schema::$available['site_copy_overrides'] = false;
    verify('Missing copy table uses exact original fallback', CmsContent::copy('home', 'ru', $defaults) === $defaults);
    Schema::$available['site_copy_overrides'] = true;

    SiteCopyOverride::$rows = [
        ['page' => 'home', 'locale' => 'ru', 'content_key' => 'hero_title', 'value' => 'DRAFT title', 'is_published' => false],
        ['page' => 'home', 'locale' => 'ru', 'content_key' => 'hero_text', 'value' => 'Published text', 'is_published' => true],
        ['page' => 'home', 'locale' => 'ru', 'content_key' => 'value_points.0', 'value' => 'First changed', 'is_published' => true],
        ['page' => 'home', 'locale' => 'ru', 'content_key' => 'array_block', 'value' => 'Do not overwrite array', 'is_published' => true],
        ['page' => 'home', 'locale' => 'ru', 'content_key' => 'rogue_key', 'value' => 'Do not add key', 'is_published' => true],
        ['page' => 'home', 'locale' => 'ru', 'content_key' => 'hero_title', 'value' => '', 'is_published' => true],
        ['page' => 'about', 'locale' => 'ru', 'content_key' => 'hero_text', 'value' => 'Other page', 'is_published' => true],
        ['page' => 'home', 'locale' => 'en', 'content_key' => 'hero_text', 'value' => 'EN only', 'is_published' => true],
    ];

    $ru = CmsContent::copy('home', 'ru', $defaults);
    verify('Only published matching page and locale fields change', $ru['hero_text'] === 'Published text');
    verify('Draft or blank title does not replace original text', $ru['hero_title'] === 'Original RU headline');
    verify('Nested scalar key editing works', $ru['value_points'] === ['First changed', 'Second']);
    verify('Structural array cannot be overwritten', $ru['array_block'] === $defaults['array_block']);
    verify('Unknown keys are not injected', !array_key_exists('rogue_key', $ru));
    verify('Different locale leaves ru override untouched', CmsContent::copy('home', 'tm', $defaults) === $defaults);
    verify('Different page leaves home override untouched', CmsContent::copy('services', 'ru', $defaults) === $defaults);
    verify('Unknown page fails closed', CmsContent::copy('unknown', 'ru', $defaults) === $defaults);
    verify('English override follows English locale only', CmsContent::copy('home', 'en', $defaults)['hero_text'] === 'EN only');

    Schema::$available['site_media_items'] = false;
    verify('Missing media table leaves gallery untouched', CmsContent::media('image', 'ru') === []);
    Schema::$available['site_media_items'] = true;
    SiteMediaItem::$rows = [
        [
            'collection'=>'home-gallery', 'kind'=>'image', 'slot'=>0, 'file_path'=>'cms/media/alpha-001.webp',
            'poster_path'=>null, 'caption_ru'=>'Фото компании', 'caption_tm'=>'', 'caption_en'=>'Company photo', 'is_published'=>true,
        ],
        [
            'collection'=>'home-gallery', 'kind'=>'image', 'slot'=>1, 'file_path'=>'cms/media/alpha-002.jpg',
            'poster_path'=>null, 'caption_ru'=>'Hidden', 'caption_tm'=>'', 'caption_en'=>'Hidden', 'is_published'=>false,
        ],
        [
            'collection'=>'home-gallery', 'kind'=>'image', 'slot'=>2, 'file_path'=>'cms/media/../secrets.webp',
            'poster_path'=>null, 'caption_ru'=>'Evil', 'caption_tm'=>'', 'caption_en'=>'Evil', 'is_published'=>true,
        ],
        [
            'collection'=>'home-gallery', 'kind'=>'image', 'slot'=>3, 'file_path'=>'cms/media/webshell.php.webp',
            'poster_path'=>null, 'caption_ru'=>'Evil', 'caption_tm'=>'', 'caption_en'=>'Evil', 'is_published'=>true,
        ],
        [
            'collection'=>'home-gallery', 'kind'=>'image', 'slot'=>4, 'file_path'=>'https://external.example/pic.jpg',
            'poster_path'=>null, 'caption_ru'=>'External', 'caption_tm'=>'', 'caption_en'=>'External', 'is_published'=>true,
        ],
        [
            'collection'=>'home-gallery', 'kind'=>'image', 'slot'=>5, 'file_path'=>'cms/media/invoice.pdf',
            'poster_path'=>null, 'caption_ru'=>'PDF', 'caption_tm'=>'', 'caption_en'=>'PDF', 'is_published'=>true,
        ],
        [
            'collection'=>'other', 'kind'=>'image', 'slot'=>1, 'file_path'=>'cms/media/other.jpg',
            'poster_path'=>null, 'caption_ru'=>'Other', 'caption_tm'=>'', 'caption_en'=>'Other', 'is_published'=>true,
        ],
        [
            'collection'=>'home-gallery', 'kind'=>'video', 'slot'=>0, 'file_path'=>'cms/media/cargo-2026.mp4',
            'poster_path'=>'cms/media/posters/cargo.webp', 'caption_ru'=>'Порт', 'caption_tm'=>'Port', 'caption_en'=>'Port', 'is_published'=>true,
        ],
        [
            'collection'=>'home-gallery', 'kind'=>'video', 'slot'=>10, 'file_path'=>'media/zny/2026/expo-2026.webm',
            'poster_path'=>'cms/media/../../.env', 'caption_ru'=>'', 'caption_tm'=>'', 'caption_en'=>'Exhibition', 'is_published'=>true,
        ],
    ];

    $images = CmsContent::media('image', 'ru');
    verify('Published image is served under storage symlink', isset($images[0]) && $images[0]['file_path'] === 'storage/cms/media/alpha-001.webp');
    verify('Localized image caption is selected', $images[0]['caption'] === 'Фото компании');
    verify('Draft images are omitted', !isset($images[1]));
    verify('Traversal and unsafe media files are rejected', count($images) === 1);
    verify('Different collection does not leak into gallery', !isset($images[5]));

    $videos = CmsContent::media('video', 'ru');
    verify('Video file and poster paths resolve correctly',
        ($videos[0]['file_path'] ?? '') === 'storage/cms/media/cargo-2026.mp4' &&
        ($videos[0]['poster_path'] ?? '') === 'storage/cms/media/posters/cargo.webp'
    );
    verify('Legacy media path remains public without storage prefix',
        ($videos[10]['file_path'] ?? '') === 'media/zny/2026/expo-2026.webm'
    );
    verify('Invalid poster is discarded, not served', array_key_exists(10, $videos) && $videos[10]['poster_path'] === null);
    verify('Missing localized caption falls back to English',
        ($videos[10]['caption'] ?? '') === 'Exhibition'
    );
    verify('Unknown media kind fails closed', CmsContent::media('document', 'ru') === []);
    verify('Unknown locale fails closed', CmsContent::media('image', 'zz') === []);

    echo "TOTAL ".$passed." CMS contract tests PASSED".PHP_EOL;
}
