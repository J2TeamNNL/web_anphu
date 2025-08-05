<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Artisan::command('debug', function () {
    Log::error('🚨 This is an ERROR message - should go to Discord!');
});
