<?php

declare(strict_types=1);

// Lightweight CI invariants, independent of Composer or a live database.
// Runtime and authorization tests are required separately before deployment.
$root = dirname(__DIR__);
$read = static function (string $path) use ($root): string {
    $contents = @file_get_contents($root . '/' . $path);
    if (! is_string($contents)) {
        fwrite(STDERR, "Missing: $path\n");
        exit(1);
    }
    return $contents;
};
$assert = static function (bool $pass, string $message): void {
    if (! $pass) {
        fwrite(STDERR, "FAIL: $message\n");
        exit(1);
    }
};

$seedAdmin = $read('database/seeders/AdminUserSeeder.php');
$seedDb = $read('database/seeders/DatabaseSeeder.php');
$routes = $read('routes/web.php');
$provider = $read('app/Providers/AppServiceProvider.php');
$shipment = $read('app/Models/Shipment.php');
$siteSettings = $read('app/Filament/Pages/SiteSettings.php');

$assert(! str_contains($seedAdmin, "Hash::make('password')"), 'Fixed admin password still present');
$assert(str_contains($seedAdmin, "environment(['local', 'testing'])"), 'Admin seeding must be development-only');
$assert(str_contains($seedDb, "environment(['local', 'testing'])"), 'Demo data seeding must be development-only');
$assert(substr_count($routes, "throttle:zny-tracking") === 2, 'Two public tracking POST routes require throttling');
$assert(substr_count($routes, "throttle:zny-submission") === 2, 'Both public submission POST routes require throttling');
$assert(str_contains($provider, "RateLimiter::for('zny-tracking'"), 'Shared tracking limiter missing');
$assert(str_contains($provider, "RateLimiter::for('zny-submission'"), 'Shared submission limiter missing');
$assert(str_contains($shipment, 'catch (\\Throwable $exception)'), 'Persisted shipment must not be blocked by SMTP');
$assert(str_contains($siteSettings, 'function canAccess(): bool'), 'Site settings page must authorize access');
$assert(str_contains($siteSettings, "hasRole('admin')"), 'Site settings must be admin-only');
fwrite(STDOUT, "ZNY_SECURITY_STATIC_CHECKS=PASS\n");
