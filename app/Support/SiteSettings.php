<?php

namespace App\Support;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteSettings
{
    /**
     * @return array<string, mixed>
     */
    public static function data(): array
    {
        return Cache::rememberForever('site_settings.payload', function (): array {
            $record = SiteSetting::query()->first();

            return [
                'company_name' => $record?->company_name ?: 'ZNY LOGISTICS',
                'company_domain' => $record?->company_domain ?: 'znylogistic.com',
                'phone_primary' => $record?->phone_primary ?: '+99364918998',
                'phone_secondary' => $record?->phone_secondary,
                'email_primary' => $record?->email_primary ?: 'info@znylogistics.com',
                'email_secondary' => $record?->email_secondary ?: 'akja@znylogistics.com',
                'address' => $record?->address ?: 'Rysgal BC, 917, Ashgabat, Turkmenistan',
                'whatsapp_number' => $record?->whatsapp_number ?: '99364918998',
                'live_chat_enabled' => (bool) ($record?->live_chat_enabled ?? config('live_chat.enabled', false)),
                'live_chat_provider' => $record?->live_chat_provider ?: config('live_chat.provider', 'tawk'),
                'live_chat_src' => $record?->live_chat_src ?: config('live_chat.src', ''),
                'footer_text' => $record?->footer_text ?: 'Strategic freight partner for air, road, and integrated cargo programs across global supply chains.',
                'tracking_cta_text' => $record?->tracking_cta_text ?: 'Need a live shipment update now?',
                'contact_cta_text' => $record?->contact_cta_text ?: 'Let’s optimize your freight operations.',
            ];
        });
    }

    public static function clearCache(): void
    {
        Cache::forget('site_settings.payload');
    }
}
