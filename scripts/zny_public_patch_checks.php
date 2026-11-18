<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$read = static function (string $path) use ($root): string {
    $value = @file_get_contents($root . '/' . $path);
    if (! is_string($value)) {
        fwrite(STDERR, "File not found: $path\n");
        exit(1);
    }
    return $value;
};
$check = static function (bool $ok, string $message): void {
    if (! $ok) {
        fwrite(STDERR, "FAIL: $message\n");
        exit(1);
    }
};

$layout = $read('resources/views/layouts/app.blade.php');
foreach (['/en', '/en/about', '/en/services', '/en/contact', '/en/tracking'] as $path) {
    $check(str_contains($layout, "'$path' =>"), "Missing SEO map entry $path");
    $check(str_contains($layout, "https://znylogistic.com$path"), "Missing canonical $path");
}
$check(str_contains($layout, 'hreflang="en"'), 'English hreflang is missing');
$contact = $read('app/Http/Controllers/ContactController.php');
$lead = $read('app/Http/Controllers/LeadController.php');
$check(str_contains($contact, 'ContactMessage::query()->create'), 'Contact DB write missing');
$check(str_contains($lead, 'Lead::query()->create'), 'Lead DB write missing');
$check(str_contains($contact, 'catch (\\Throwable $exception)'), 'Contact mail failure handling missing');
$check(str_contains($lead, 'catch (\\Throwable $exception)'), 'Lead mail failure handling missing');
$check(str_contains($contact, 'Log::error('), 'Contact error logging missing');
$check(str_contains($lead, 'Log::error('), 'Lead error logging missing');

$resource = $read('app/Filament/Resources/ContactMessageResource.php');
$check(str_contains($resource, 'canCreate(): bool'), 'Contact message resource must not support creation');
$check(str_contains($resource, "ViewAction::make()"), 'Contact message view action missing');
$check(str_contains($resource, "nl2br(e("), 'Contact message rendering must escape HTML');
$read('app/Filament/Resources/ContactMessageResource/Pages/ListContactMessages.php');
$read('app/Filament/Resources/ContactMessageResource/Pages/ViewContactMessage.php');

fwrite(STDOUT, "ZNY_SEO_AND_INTAKE_STATIC_CHECKS=PASS\n");
