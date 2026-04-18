<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_domain')->nullable();
            $table->string('phone_primary')->nullable();
            $table->string('phone_secondary')->nullable();
            $table->string('email_primary')->nullable();
            $table->string('email_secondary')->nullable();
            $table->string('address')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->boolean('live_chat_enabled')->default(false);
            $table->string('live_chat_provider')->nullable();
            $table->text('live_chat_src')->nullable();
            $table->text('footer_text')->nullable();
            $table->string('tracking_cta_text')->nullable();
            $table->string('contact_cta_text')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
