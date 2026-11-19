<?php

namespace App\Support;

final class CmsMediaCatalog
{
    /**
     * Editors must choose an actual placement. Each page has its own image
     * slots; the homepage gallery additionally supports video uploads.
     *
     * @return array<string, string>
     */
    public static function collections(): array
    {
        return [
            'home-gallery' => 'Главная — фото и видео галерея',
            'page-home' => 'Главная — фон и карточки услуг',
            'page-about' => 'О компании — фотографии',
            'page-services' => 'Услуги — фотографии',
            'page-contact' => 'Контакты — фотографии',
            'page-tracking' => 'Отслеживание — фотографии',
        ];
    }

    /**
     * @return array<int,string>
     */
    public static function slots(string $collection, string $kind): array
    {
        if ($collection === 'home-gallery') {
            if ($kind === 'image') {
                $items = [];
                for ($slot = 0; $slot <= 30; $slot++) {
                    $items[$slot] = $slot < 9
                        ? 'Фото галереи — позиция '.($slot + 1)
                        : 'Добавить фото — позиция '.($slot + 1);
                }
                return $items;
            }

            if ($kind === 'video') {
                $items = [];
                for ($slot = 0; $slot <= 20; $slot++) {
                    $items[$slot] = $slot < 7
                        ? 'Видео галереи — позиция '.($slot + 1)
                        : 'Добавить видео — позиция '.($slot + 1);
                }
                return $items;
            }
            return [];
        }

        if ($kind !== 'image') {
            return [];
        }

        return match ($collection) {
            'page-home' => [
                0 => 'Главная — большое фоновое изображение',
                1 => 'Главная — авиаперевозки',
                2 => 'Главная — автоперевозки',
                3 => 'Главная — морские перевозки',
                4 => 'Главная — склад и консолидация',
            ],
            'page-about' => [
                0 => 'О компании — фоновое изображение',
                1 => 'О компании — склад/операции',
            ],
            'page-services' => [
                0 => 'Услуги — авиа',
                1 => 'Услуги — автотранспорт',
                2 => 'Услуги — морские перевозки',
            ],
            'page-contact' => [
                0 => 'Контакты — фоновое изображение',
                1 => 'Контакты — операторская служба',
            ],
            'page-tracking' => [
                0 => 'Отслеживание — фоновое изображение',
                1 => 'Отслеживание — автомобиль',
            ],
            default => [],
        };
    }

    public static function supports(string $collection, string $kind): bool
    {
        return self::slots($collection, $kind) !== [];
    }

    public static function allows(string $collection, string $kind, int $slot): bool
    {
        return array_key_exists($slot, self::slots($collection, $kind));
    }
}
