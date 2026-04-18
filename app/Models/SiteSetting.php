<?php

namespace App\Models;

use App\Support\SiteSettings;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'company_name',
        'company_domain',
        'phone_primary',
        'phone_secondary',
        'email_primary',
        'email_secondary',
        'address',
        'whatsapp_number',
        'live_chat_enabled',
        'live_chat_provider',
        'live_chat_src',
        'footer_text',
        'tracking_cta_text',
        'contact_cta_text',
    ];

    protected $casts = [
        'live_chat_enabled' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => SiteSettings::clearCache());
    }
}
