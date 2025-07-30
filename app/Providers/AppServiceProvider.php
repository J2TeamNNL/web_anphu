<?php

namespace App\Providers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Enums\CategoryType;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

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
