<?php

namespace App\Providers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\MenuController;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        Paginator::useBootstrap();

        Model::shouldBeStrict();
        
        try {
            view()->composer('customers.partials.nav_bar', function ($view) {
                $view->with(MenuController::portfolioNavbarData());
                $view->with(MenuController::articleNavbarData());
            });
        } catch (\Throwable $e) {
            Log::error('AppServiceProvider Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

    }
}
