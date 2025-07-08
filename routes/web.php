<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/about', [CustomerController::class, 'about'])->name('customers.about');

Route::group(['prefix' => 'services'], function () {
   Route::get('/permit', [CustomerController::class, 'servicesPermit'])->name('services.permit');
   Route::get('/design', [CustomerController::class, 'servicesDesign'])->name('services.design');
   Route::get('/construction', [CustomerController::class, 'servicesContruction'])->name('services.construction');
});

Route::get('/elements', [CustomerController::class, 'elements']) ->name('customers.elements');
Route::get('/contact', [CustomerController::class, 'contact'])->name('customers.contact');
Route::get('/portfolio', [CustomerController::class, 'portfolio'])->name('customers.portfolio');
Route::get('/blog', [CustomerController::class, 'blog'])->name('customers.blog');


