<?php

namespace Tests\Feature;

use App\Filament\Pages\SiteSettings;
use App\Filament\Resources\SiteCopyOverrideResource\Pages\CreateSiteCopyOverride;
use App\Filament\Resources\SiteCopyOverrideResource\Pages\EditSiteCopyOverride;
use App\Filament\Resources\SiteCopyOverrideResource\Pages\ListSiteCopyOverrides;
use App\Filament\Resources\SiteMediaItemResource\Pages\CreateSiteMediaItem;
use App\Filament\Resources\SiteMediaItemResource\Pages\EditSiteMediaItem;
use App\Filament\Resources\SiteMediaItemResource\Pages\ListSiteMediaItems;
use App\Models\SiteCopyOverride;
use App\Models\SiteMediaItem;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Disposable SQLite/Filament integration; not safe to execute against production.
 * Requires the earlier cms-laravel-smoke.php fixture of two users and roles.
 */
final class CmsFilamentLivewireTest extends TestCase
{
    protected User $admin;
    protected User $manager;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel(Filament::getPanel('admin'));
        $this->admin = User::query()->where('email', 'cms-admin@test.invalid')->firstOrFail();
        $this->manager = User::query()->where('email', 'cms-manager@test.invalid')->firstOrFail();
    }

    public function test_admin_cms_pages_render_and_manager_is_denied(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(SiteSettings::class)->assertOk();
        Livewire::test(ListSiteCopyOverrides::class)->assertOk();
        Livewire::test(ListSiteMediaItems::class)->assertOk();
        Livewire::test(CreateSiteMediaItem::class)->assertOk();

        $this->actingAs($this->manager);

        Livewire::test(ListSiteCopyOverrides::class)->assertForbidden();
        Livewire::test(CreateSiteMediaItem::class)->assertForbidden();
    }

    public function test_localized_text_create_publish_and_restore_through_forms(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(CreateSiteCopyOverride::class)
            ->fillForm([
                'page' => 'home',
                'locale' => 'en',
                'content_key' => 'hero_title',
                'value' => 'English CMS test heading',
                'is_published' => false,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $record = SiteCopyOverride::query()
            ->where('page', 'home')
            ->where('locale', 'en')
            ->where('content_key', 'hero_title')
            ->firstOrFail();

        $this->assertFalse($record->is_published);

        Livewire::test(EditSiteCopyOverride::class, ['record' => $record->getKey()])
            ->fillForm(['is_published' => true])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertTrue($record->fresh()->is_published);
    }

    public function test_real_file_upload_replacement_and_original_retention(): void
    {
        $this->actingAs($this->admin);
        Storage::fake('public');

        $image = UploadedFile::fake()->image('cms-original.jpg', 640, 420);
        Livewire::test(CreateSiteMediaItem::class)
            ->fillForm([
                'collection' => 'home-gallery',
                'kind' => 'image',
                'slot' => 8,
                'file_path' => $image,
                'caption_ru' => 'Груз',
                'caption_tm' => 'Ýük',
                'caption_en' => 'Cargo',
                'is_published' => false,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $media = SiteMediaItem::query()
            ->where('collection', 'home-gallery')
            ->where('kind', 'image')
            ->where('slot', 8)
            ->firstOrFail();

        $oldPath = (string) $media->file_path;
        $this->assertStringStartsWith('cms/media/', $oldPath);
        Storage::disk('public')->assertExists($oldPath);

        $replacement = UploadedFile::fake()->image('cms-replacement.jpg', 640, 420);
        Livewire::test(EditSiteMediaItem::class, ['record' => $media->getKey()])
            // As in the UI, clear the existing upload before selecting a replacement.
            ->fillForm(['file_path' => null])
            ->fillForm(['file_path' => $replacement, 'is_published' => true])
            ->call('save')
            ->assertHasNoFormErrors();

        $media->refresh();
        $this->assertTrue($media->is_published);
        fwrite(STDERR, "CMS_MEDIA_REPLACE_DEBUG old=".$oldPath." new=".$media->file_path.PHP_EOL);
        $this->assertNotSame($oldPath, $media->file_path);
        Storage::disk('public')->assertExists($media->file_path);
        Storage::disk('public')->assertExists($oldPath);
    }
}
