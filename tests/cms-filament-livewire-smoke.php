<?php
declare(strict_types=1);

/** Disposable Laravel + Livewire/Filament tests. Never run against production. */
set_exception_handler(static function (\Throwable $e): void {
    fwrite(STDERR, "CMS_LIVEWIRE_UNCAUGHT: ".get_class($e).": ".$e->getMessage()." @ ".$e->getFile().":".$e->getLine().PHP_EOL.$e->getTraceAsString().PHP_EOL);
    exit(1);
});
set_error_handler(static function (int $severity, string $message, string $file, int $line): bool {
    if (!(error_reporting() & $severity)) {
        return false;
    }
    fwrite(STDERR, "CMS_LIVEWIRE_PHP_ERROR: ".$message." @ ".$file.":".$line.PHP_EOL);
    return false;
});
fwrite(STDERR, "CMS_LIVEWIRE_TRACE: startup".PHP_EOL);
require dirname(__DIR__).'/vendor/autoload.php';
$app = require dirname(__DIR__).'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
fwrite(STDERR, "CMS_LIVEWIRE_TRACE: app bootstrapped".PHP_EOL);

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

function okCms(string $test, bool $condition): void
{
    if (!$condition) {
        fwrite(STDERR, "FAIL ".$test.PHP_EOL);
        exit(1);
    }
    echo "PASS ".$test.PHP_EOL;
}

$admin = User::where('email','cms-admin@test.invalid')->firstOrFail();
$manager = User::where('email','cms-manager@test.invalid')->firstOrFail();
fwrite(STDERR, "CMS_LIVEWIRE_TRACE: selecting panel".PHP_EOL);
Filament::setCurrentPanel(Filament::getPanel('admin'));
fwrite(STDERR, "CMS_LIVEWIRE_TRACE: panel selected".PHP_EOL);
Auth::login($admin);

Livewire::test(SiteSettings::class)->assertOk();
Livewire::test(ListSiteCopyOverrides::class)->assertOk();
Livewire::test(ListSiteMediaItems::class)->assertOk();
Livewire::test(CreateSiteMediaItem::class)->assertOk();
echo "PASS admin configuration, text list, media list and media create pages render".PHP_EOL;

Livewire::test(CreateSiteCopyOverride::class)
    ->fillForm([
        'page' => 'home', 'locale' => 'en', 'content_key' => 'hero_title',
        'value' => 'English CMS test heading',
        'is_published' => false,
    ])
    ->call('create')
    ->assertHasNoFormErrors();

$record = SiteCopyOverride::where('page','home')
    ->where('locale','en')->where('content_key','hero_title')->firstOrFail();
okCms('Form creates unpublished localized copy', $record->value === 'English CMS test heading' && !$record->is_published);

Livewire::test(EditSiteCopyOverride::class, ['record' => $record->getKey()])
    ->fillForm(['is_published'=>true])
    ->call('save')
    ->assertHasNoFormErrors();
okCms('Form publishes existing localized copy', $record->fresh()->is_published === true);

Storage::fake('public');
$firstImage = UploadedFile::fake()->image('cms-first.jpg',640,420);
Livewire::test(CreateSiteMediaItem::class)
    ->fillForm([
        'collection'=>'home-gallery', 'kind'=>'image', 'slot'=>8,
        'file_path'=>[$firstImage],
        'caption_ru'=>'Тестовый груз', 'caption_tm'=>'Synag ýük',
        'caption_en'=>'Test cargo', 'is_published'=>false,
    ])
    ->call('create')
    ->assertHasNoFormErrors();

$media = SiteMediaItem::where('collection','home-gallery')
    ->where('kind','image')->where('slot',8)->firstOrFail();
okCms('Filament uploaded new image to public disk',
    str_starts_with($media->file_path,'cms/media/') &&
    Storage::disk('public')->exists($media->file_path));

$previousPath = $media->file_path;
$replacement = UploadedFile::fake()->image('cms-replacement.jpg',640,420);
Livewire::test(EditSiteMediaItem::class, ['record' => $media->getKey()])
    ->fillForm([
        'file_path'=>[$replacement], 'is_published'=>true,
    ])
    ->call('save')
    ->assertHasNoFormErrors();
$media->refresh();
okCms('Filament file replacement changes the same slot',
    $media->is_published &&
    $media->file_path !== $previousPath &&
    Storage::disk('public')->exists($media->file_path));
okCms('Original image retained for rollback', Storage::disk('public')->exists($previousPath));

Auth::logout();
Auth::login($manager);
Livewire::test(ListSiteCopyOverrides::class)->assertForbidden();
Livewire::test(CreateSiteMediaItem::class)->assertForbidden();
echo "PASS manager blocked from CMS Livewire routes".PHP_EOL;

echo 'ALL FILAMENT LIVEWIRE CMS TESTS PASSED'.PHP_EOL;
