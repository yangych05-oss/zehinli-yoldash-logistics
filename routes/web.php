<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ru');

Route::get('/track', [TrackingController::class, 'public'])->name('tracking.public');
Route::post('/track', [TrackingController::class, 'publicSearch'])->name('tracking.public.search');

Route::prefix('{locale}')
    ->whereIn('locale', ['ru', 'tm', 'en'])
    ->middleware('set.locale')
    ->group(function (): void {
        Route::get('/', [PageController::class, 'home'])->name('home');
        Route::get('/about', [PageController::class, 'about'])->name('about');
        Route::get('/services', [PageController::class, 'services'])->name('services');
        Route::get('/contact', [PageController::class, 'contact'])->name('contact');
        Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
        Route::post('/tracking', [TrackingController::class, 'search'])->name('tracking.search');

        Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
        Route::post('/quote-request', [LeadController::class, 'store'])->name('quote.store');
    });
