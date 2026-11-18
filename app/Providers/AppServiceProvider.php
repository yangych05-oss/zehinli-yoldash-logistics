<?php

namespace App\Providers;

use App\Support\SiteSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share limits across all locales and the public /track endpoint,
        // keyed by client IP rather than by individual URL.
        RateLimiter::for('zny-tracking', fn (Request $request): Limit =>
            Limit::perMinute(30)->by('tracking:' . $request->ip())
        );
        RateLimiter::for('zny-submission', fn (Request $request): Limit =>
            Limit::perMinute(8)->by('submission:' . $request->ip())
        );

        View::composer('*', function ($view): void {
            $view->with('siteSettings', SiteSettings::data());
        });
    }
}
