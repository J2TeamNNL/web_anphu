<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('debug', function () {
    dd(config('cloudinary'));
});
