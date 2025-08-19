<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookFetchController;

Route::post('/facebook/fetch', [FacebookFetchController::class, 'fetchPost']);