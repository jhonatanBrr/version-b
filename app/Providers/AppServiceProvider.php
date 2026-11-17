<?php

namespace App\Providers;

use App\Catalog\ArrayProductRepository;
use App\Catalog\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            ProductRepository::class,
            fn () => new ArrayProductRepository(require resource_path('data/catalog.php')),
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
