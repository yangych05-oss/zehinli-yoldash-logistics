<?php
declare(strict_types=1);

/**
 * Run only in an isolated CI Laravel instance with a disposable SQLite DB.
 * Assumes php artisan migrate --force has completed on that DB.
 */
require dirname(__DIR__).'/vendor/autoload.php';
$app = require dirname(__DIR__).'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Filament\Pages\SiteSettings;
use App\Filament\Resources\SiteCopyOverrideResource;
use App\Filament\Resources\SiteMediaItemResource;
use App\Models\SiteCopyOverride;
use App\Models\SiteMediaItem;
use App\Models\User;
use App\Support\CmsContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

function checkCms(string $label, bool $condition): void
{
    if (!$condition) {
        fwrite(STDERR, "FAIL: ".$label.PHP_EOL);
        exit(1);
    }
    echo "PASS: ".$label.PHP_EOL;
}

checkCms('CMS schema migrated', Schema::hasTable('site_copy_overrides') && Schema::hasTable('site_media_items'));

$admin = User::create([
    'name' => 'CMS Test Admin',
    'email' => 'cms-admin@test.invalid',
    'password' => \Illuminate\Support\Facades\Hash::make('random-ci-only-password-2026'),
]);
$manager = User::create([
    'name' => 'CMS Test Manager',
    'email' => 'cms-manager@test.invalid',
    'password' => \Illuminate\Support\Facades\Hash::make('random-ci-only-password-2026'),
]);
Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);
$admin->assignRole('admin');
$manager->assignRole('manager');

Auth::login($manager);
checkCms('Manager cannot open text editor', !SiteCopyOverrideResource::canViewAny());
checkCms('Manager cannot create text overrides', !SiteCopyOverrideResource::canCreate());
checkCms('Manager cannot open media editor', !SiteMediaItemResource::canViewAny());
checkCms('Manager cannot edit company settings', !SiteSettings::canAccess());
Auth::logout();

Auth::login($admin);
checkCms('Admin can open text editor', SiteCopyOverrideResource::canViewAny());
checkCms('Admin can create text overrides', SiteCopyOverrideResource::canCreate());
checkCms('Admin can open media editor', SiteMediaItemResource::canViewAny());
checkCms('Admin can edit company settings', SiteSettings::canAccess());

$defaults = ['hero_title' => 'Existing title', 'hero_text' => 'Existing introduction'];
$draft = SiteCopyOverride::create([
    'page' => 'home', 'locale' => 'ru', 'content_key' => 'hero_title',
    'value' => 'New title', 'is_published' => false, 'updated_by' => $admin->id,
]);
checkCms('Saved draft does not change home page', CmsContent::copy('home', 'ru', $defaults) === $defaults);

$draft->update(['is_published' => true]);
checkCms('Published Russian title overrides original',
    CmsContent::copy('home', 'ru', $defaults)['hero_title'] === 'New title');
checkCms('Other language remains untouched',
    CmsContent::copy('home', 'en', $defaults) === $defaults);
$draft->update(['is_published' => false]);
checkCms('Unpublish restores original',
    CmsContent::copy('home', 'ru', $defaults) === $defaults);

$media = SiteMediaItem::create([
    'collection' => 'home-gallery', 'kind' => 'image', 'slot' => 3,
    'file_path' => 'cms/media/cargo-original.webp',
    'caption_ru' => 'Контейнеры', 'caption_tm' => 'Konteýnerler',
    'caption_en' => 'Containers', 'is_published' => false, 'updated_by' => $admin->id,
]);
checkCms('Draft media hidden', CmsContent::media('image', 'ru') === []);
$media->update(['is_published' => true]);
checkCms('Published media uses public storage',
    (CmsContent::media('image', 'ru')[3]['file_path'] ?? '') === 'storage/cms/media/cargo-original.webp');
$media->update(['file_path' => 'cms/media/cargo-replacement.jpg']);
checkCms('Replacing published media updates the same slot',
    (CmsContent::media('image', 'ru')[3]['file_path'] ?? '') === 'storage/cms/media/cargo-replacement.jpg');
$media->update(['is_published' => false]);
checkCms('Unpublished replacement is hidden', CmsContent::media('image', 'ru') === []);

$media->update(['file_path' => 'cms/media/../.env', 'is_published' => true]);
checkCms('Invalid database path is rejected at render time', CmsContent::media('image', 'ru') === []);
$media->update(['is_published' => false]);

try {
    SiteMediaItem::create([
        'collection' => 'home-gallery', 'kind' => 'image', 'slot' => 3,
        'file_path' => 'cms/media/collision.webp', 'is_published' => false,
    ]);
    checkCms('Unique slot enforced by database', false);
} catch (\Illuminate\Database\QueryException $expected) {
    checkCms('Unique slot enforced by database', true);
}

Auth::logout();
checkCms('Unauthenticated CMS text editor is not accessible', !SiteCopyOverrideResource::canViewAny());
checkCms('Unauthenticated media editor is not accessible', !SiteMediaItemResource::canViewAny());

echo 'ALL CMS INTEGRATION TESTS PASSED'.PHP_EOL;
