<?php

namespace App\View\Composers;

use App\Models\Service;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class ServiceComposer
{   
    protected static $cachedServices;

    public function compose(View $view)
    {   
        if (! self::$cachedServices) {
            self::$cachedServices = Cache::rememberForever('services', fn() => Service::all());
        }

        $view->with('services', self::$cachedServices);
    }
}
