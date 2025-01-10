<?php

namespace App\Providers;

use App\Repository\User\UserRepo;
use App\Repository\User\UserContract;
use Illuminate\Support\ServiceProvider;
use App\Repository\Product\ProductContract;
use App\Repository\Product\ProductRepo;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserContract::class, UserRepo::class);
        $this->app->bind(ProductContract::class, ProductRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
