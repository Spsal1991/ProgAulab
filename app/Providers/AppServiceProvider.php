<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Region;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('categories')) {
            View::share('categories', Category::all());
        }

        if (Schema::hasTable('regions')) {
            View::share('regions', Region::all());
        }
        if (Schema::hasTable('products')) {
            View::share('products', Product::all());
        }
        Paginator::useBootstrap();
    }
}
