<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_copy_overrides', function (Blueprint $table): void {
            $table->id();
            $table->string('page', 40);
            $table->string('locale', 2);
            $table->string('content_key', 160);
            $table->longText('value');
            $table->boolean('is_published')->default(false);
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->unique(['page', 'locale', 'content_key'], 'site_copy_unique');
            $table->index(['page', 'locale', 'is_published'], 'site_copy_published');
        });

        Schema::create('site_media_items', function (Blueprint $table): void {
            $table->id();
            $table->string('collection', 64)->default('home-gallery');
            $table->string('kind', 10); // image or video
            $table->unsignedSmallInteger('slot');
            $table->string('file_path', 512);
            $table->string('poster_path', 512)->nullable();
            $table->string('caption_ru', 255)->nullable();
            $table->string('caption_tm', 255)->nullable();
            $table->string('caption_en', 255)->nullable();
            $table->boolean('is_published')->default(false);
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['collection', 'kind', 'slot'], 'site_media_slot_unique');
            $table->index(['collection', 'kind', 'is_published'], 'site_media_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_media_items');
        Schema::dropIfExists('site_copy_overrides');
    }
};
