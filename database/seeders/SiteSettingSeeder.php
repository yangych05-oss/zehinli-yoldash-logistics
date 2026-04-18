<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(['id' => 1], [
            'company_name' => 'ZNY LOGISTICS',
            'company_domain' => 'znylogistic.com',
            'phone_primary' => '+99364918998',
            'phone_secondary' => null,
            'email_primary' => 'info@znylogistics.com',
            'email_secondary' => 'akja@znylogistics.com',
            'address' => 'Rysgal BC, 917, Ashgabat, Turkmenistan',
            'whatsapp_number' => '99364918998',
            'live_chat_enabled' => true,
            'live_chat_provider' => config('live_chat.provider', 'tawk'),
            'live_chat_src' => config('live_chat.src', ''),
            'footer_text' => 'Strategic freight partner for air, road, and integrated cargo programs across global supply chains.',
            'tracking_cta_text' => 'Need a live shipment update now?',
            'contact_cta_text' => 'Let’s optimize your freight operations.',
        ]);
    }
}
