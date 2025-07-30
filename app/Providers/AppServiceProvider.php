<?php

namespace App\Providers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Enums\CategoryType;
use App\Models\Category;

use App\Http\Controllers\MenuController;

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
        if(!app()->isProduction()) {
            Model::shouldBeStrict();
        }
        
        view()->composer('customers.partials.nav_bar', function ($view) {
            $view->with(MenuController::portfolioNavbarData());
            $view->with(MenuController::articleNavbarData());
        });

    }
}
