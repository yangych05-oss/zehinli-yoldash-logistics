<?php

namespace App\Support;

/**
 * Human-readable, allowlisted text fields in the five localized Blade pages.
 * Gallery images/videos are managed in the separate Media resource.
 */
final class CmsFieldCatalog
{
    private const ROOT = [
        'home' => [
            'hero_eyebrow','hero_title','hero_text','hero_primary','hero_secondary',
            'services_intro','services_title','value_intro','value_title',
        ],
        'about' => ['eyebrow','title','intro'],
        'services' => [
            'eyebrow','title','text','quote_title','quote_text',
            'email','phone','origin','destination','cargo',
        ],
        'contact' => [
            'intro','title','text','wa','phone','address','email','alternate',
            'priority_title','priority_text','placeholder_email','placeholder_phone','form_title',
        ],
        'tracking' => [
            'eyebrow','title','text','code','access','summary',
            'timeline','support_title','support_text',
        ],
    ];

    /** [collection, number of items, allowed string keys within each item] */
    private const REPEATED = [
        'home' => [
            ['trust_kpis', 3, ['label','value']],
            ['services', 4, ['title','text','alt']],
            ['value_points', 3, []],
        ],
        'about' => [
            ['pillars', 3, ['title','text']],
        ],
        'services' => [
            ['cards', 3, ['label','title','text','alt']],
        ],
    ];

    /**
     * @return array<string,string> Values are the same keys consumed by the public templates.
     */
    public static function options(string $page): array
    {
        if (!array_key_exists($page, self::ROOT)) {
            return [];
        }

        $fields = [];
        foreach (self::ROOT[$page] as $key) {
            $fields[$key] = self::readable($key);
        }

        foreach (self::REPEATED[$page] ?? [] as [$collection, $count, $subfields]) {
            for ($i = 0; $i < $count; $i++) {
                if ($subfields === []) {
                    $key = $collection.'.'.$i;
                    $fields[$key] = self::readable($collection).' '.($i + 1);
                    continue;
                }

                foreach ($subfields as $field) {
                    $key = $collection.'.'.$i.'.'.$field;
                    $fields[$key] = self::readable($collection).' '.($i + 1).' · '.self::readable($field);
                }
            }
        }

        return $fields;
    }

    public static function contains(string $page, string $key): bool
    {
        return array_key_exists($key, self::options($page));
    }

    private static function readable(string $name): string
    {
        return ucwords(str_replace('_', ' ', $name));
    }
}
