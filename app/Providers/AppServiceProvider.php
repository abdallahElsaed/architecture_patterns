<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Ports\Product\ProductRepositoryInterface;
use App\Shell\Infrastructure\Repositories\Product\ProductRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // make binding for ProductRepositoryInterface with productRepository
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
