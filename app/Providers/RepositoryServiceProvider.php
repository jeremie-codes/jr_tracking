<?php

namespace App\Providers;

use App\Repository\User\UserRepo;
use App\Repository\Order\OrderRepo;
use App\Repository\User\UserContract;
use App\Repository\Order\OrderContract;
use App\Repository\Product\ProductRepo;
use Illuminate\Support\ServiceProvider;
use App\Repository\Cart\CartSessionRepo;
use App\Repository\Cart\CartInterfaceRepo;
use App\Repository\Product\ProductContract;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserContract::class, UserRepo::class);
        $this->app->bind(ProductContract::class, ProductRepo::class);
        $this->app->bind(OrderContract::class, OrderRepo::class);
        $this->app->bind(CartInterfaceRepo::class, CartSessionRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
