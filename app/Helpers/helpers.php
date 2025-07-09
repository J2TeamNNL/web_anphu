<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isActive')) {
    function isActive($routes, $class = 'active') {
        $current = Route::currentRouteName();

        if (is_array($routes) && in_array($current, $routes)) return $class;
        if (is_string($routes) && $current === $routes) return $class;

        return '';
    }
}
