<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table): void {
            if (! Schema::hasColumn('site_settings', 'logo_image')) {
                $table->string('logo_image')->nullable();
            }

            if (! Schema::hasColumn('site_settings', 'whatsapp_qr_image')) {
                $table->string('whatsapp_qr_image')->nullable();
            }

            if (! Schema::hasColumn('site_settings', 'whatsapp_link')) {
                $table->string('whatsapp_link')->nullable();
            }

            if (! Schema::hasColumn('site_settings', 'hero_title_ru')) {
                $table->text('hero_title_ru')->nullable();
            }

            if (! Schema::hasColumn('site_settings', 'hero_title_tm')) {
                $table->text('hero_title_tm')->nullable();
            }

            if (! Schema::hasColumn('site_settings', 'hero_subtitle_ru')) {
                $table->text('hero_subtitle_ru')->nullable();
            }

            if (! Schema::hasColumn('site_settings', 'hero_subtitle_tm')) {
                $table->text('hero_subtitle_tm')->nullable();
            }

            if (! Schema::hasColumn('site_settings', 'footer_text_ru')) {
                $table->text('footer_text_ru')->nullable();
            }

            if (! Schema::hasColumn('site_settings', 'footer_text_tm')) {
                $table->text('footer_text_tm')->nullable();
            }

            if (! Schema::hasColumn('site_settings', 'address_ru')) {
                $table->text('address_ru')->nullable();
            }

            if (! Schema::hasColumn('site_settings', 'address_tm')) {
                $table->text('address_tm')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Non-destructive: these existing settings may contain live company data.
        // Database rollback must not silently erase logo, hero, footer or address.
    }
};
