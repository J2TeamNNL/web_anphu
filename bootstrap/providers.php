<?php

$providers = [
    App\Providers\AppServiceProvider::class,
    App\Providers\CloudinaryServiceProvider::class,
    App\Providers\ViewServiceProvider::class,
];

// Only register Telescope in non-production environments
if (class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
    $providers[] = App\Providers\TelescopeServiceProvider::class;
}

return $providers;
