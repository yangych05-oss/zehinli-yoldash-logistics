<?php

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\SecurityResponseHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'set.locale' => SetLocale::class,
        ]);
        $middleware->append(SecurityResponseHeaders::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Register the Laravel default exception handler for HTTP and Livewire tests.
    })
    ->create();
