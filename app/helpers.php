<?php

use App\Support\SiteSettings;

if (!function_exists('site_setting_defaults')) {
    /**
     * @return array<string, mixed>
     */
    function site_setting_defaults(): array
    {
        return [
            'company_name' => 'ZNY LOGISTICS',
            'company_domain' => 'znylogistic.com',
            'phone_primary' => '+99364918998',
            'phone_secondary' => null,
            'email_primary' => 'info@znylogistics.com',
            'email_secondary' => 'akja@znylogistics.com',
            'address' => 'Rysgal BC, 917, Ashgabat, Turkmenistan',
            'whatsapp_number' => '99364918998',
            'live_chat_enabled' => false,
            'live_chat_provider' => 'tawk',
            'live_chat_src' => '',
            'footer_text' => 'Strategic freight partner for air, road, and integrated cargo programs across global supply chains.',
            'tracking_cta_text' => 'Need a live shipment update now?',
            'contact_cta_text' => 'Let’s optimize your freight operations.',
        ];
    }
}

if (!function_exists('site_setting')) {
    function site_setting(string $key, mixed $default = null): mixed
    {
        $fallbacks = site_setting_defaults();

        try {
            $settings = SiteSettings::data();
        } catch (\Throwable) {
            $settings = [];
        }

        return $settings[$key] ?? $default ?? ($fallbacks[$key] ?? null);
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
