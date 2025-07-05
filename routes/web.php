<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/about', [CustomerController::class, 'about'])->name('customers.about');
Route::get('/services', [CustomerController::class, 'services']) ->name('customers.services');
Route::get('/elements', [CustomerController::class, 'elements']) ->name('customers.elements');
Route::get('/contact', [CustomerController::class, 'contact'])->name('customers.contact');
Route::get('/portfolio', [CustomerController::class, 'portfolio'])->name('customers.portfolio');
Route::get('/blog', [CustomerController::class, 'blog'])->name('customers.blog');


