<?php

use App\Services\FacebookApiService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Artisan::command('debug', function () {
    $facebookService = FacebookApiService::make();
    $pages = $facebookService->getPagePostsWithCursor(1);
    dd($pages);
});
