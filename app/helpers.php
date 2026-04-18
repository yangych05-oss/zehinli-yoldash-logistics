<?php

if (!function_exists('whatsapp_link')) {
    function whatsapp_link() {
        try {
            $settings = \App\Models\SiteSetting::first();

            if (!$settings || !$settings->whatsapp_number) {
                return '#';
            }

            return 'https://wa.me/' . preg_replace('/\D/', '', $settings->whatsapp_number);
        } catch (\Throwable $e) {
            return '#';
        }
    }
}
