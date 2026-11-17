<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ComingSoonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::redirect('/', '/'.config('app.supported_locales')[0]);

Route::prefix('{locale}')
    ->whereIn('locale', config('app.supported_locales'))
    ->middleware(SetLocale::class)
    ->group(function (): void {
        Route::get('/', HomeController::class)->name('home');
        Route::get('/prodotti/{slug}', ProductController::class)->name('products.show');
        Route::get('/checkout', CheckoutController::class)->name('checkout');
        Route::get('/in-arrivo', ComingSoonController::class)->name('coming-soon');
    });

// Unknown paths render the localized 404 page (locale taken from the first segment).
Route::fallback(function () {
    $segment = request()->segment(1);
    $locale = in_array($segment, config('app.supported_locales'), true) ? $segment : config('app.supported_locales')[0];

    app()->setLocale($locale);
    URL::defaults(['locale' => $locale]);

    return response()->view('errors.404', [], 404);
});
