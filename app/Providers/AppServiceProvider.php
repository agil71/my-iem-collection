<?php

namespace App\Providers;

use App\Services\CartService;
use App\View\Composers\CartComposer;
use App\View\Composers\CartItemsComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CartService::class);
    }

    public function boot(): void
    {
        View::composer('layouts.app', CartComposer::class);
        View::composer(['products.index', 'products.show'], CartItemsComposer::class);
    }
}
