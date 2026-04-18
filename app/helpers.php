<?php

use App\Support\SiteSettings;

if (!function_exists('site_setting')) {
    function site_setting(string $key, mixed $default = null): mixed
    {
        return SiteSettings::data()[$key] ?? $default;
    }
}

if (!function_exists('whatsapp_link')) {
    function whatsapp_link(): string
    {
        $rawNumber = (string) site_setting('whatsapp_number', '');
        $sanitizedNumber = preg_replace('/\D+/', '', $rawNumber) ?? '';

        if ($sanitizedNumber === '') {
            return '#';
        }

        return 'https://wa.me/'.$sanitizedNumber;
    }
}
