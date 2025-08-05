<?php

namespace App\Providers;

use App\Services\CloudinaryService;
use Illuminate\Support\ServiceProvider;

class CloudinaryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CloudinaryService::class, function ($app) {
            return new CloudinaryService();
        });
        
        // Alias for easier access
        $this->app->alias(CloudinaryService::class, 'cloudinary');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
