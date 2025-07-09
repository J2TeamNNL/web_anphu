<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


Route::get('/', [CustomerController::class, 'index'])->name('customers.index');

Route::group(['prefix' => 'about'], function () {
   Route::get('/anphu', [CustomerController::class, 'aboutAnphu'])->name('about.anphu');
   Route::get('/open-letter', [CustomerController::class, 'aboutOpenLetter'])->name('about.open_letter');
   Route::get('/cultural-values', [CustomerController::class, 'aboutCulturalValues'])->name('about.cultural_values');

});

Route::group(['prefix' => 'services'], function () {
   Route::get('/permit', [CustomerController::class, 'servicesPermit'])->name('services.permit');
   Route::get('/design', [CustomerController::class, 'servicesDesign'])->name('services.design');
   Route::get('/construction-full', [CustomerController::class, 'servicesContructionFull'])->name('services.construction_full');
   Route::get('/construction-raw', [CustomerController::class, 'servicesContructionRaw'])->name('services.construction_raw');
});

Route::group(['prefix' => 'portfolio'], function () {
   Route::get('/villa', [CustomerController::class, 'portfolioVilla'])->name('portfolio.villa');
   Route::get('/town-house', [CustomerController::class, 'portfolioTownHouse'])->name('portfolio.town_house');
   Route::get('/trading-house', [CustomerController::class, 'portfolioTradingHouse'])->name('portfolio.trading_house');
});

Route::group(['prefix' => 'price'], function () {
   Route::get('/full', [CustomerController::class, 'priceFull'])->name('price.full');
   Route::get('/raw', [CustomerController::class, 'priceRaw'])->name('price.raw');
   Route::get('/design', [CustomerController::class, 'priceDesign'])->name('price.design');
   Route::get('/permit', [CustomerController::class, 'pricePermit'])->name('price.permit');
});

Route::get('/consultant', [CustomerController::class, 'consultant'])->name('customers.consultant');
Route::get('/blog', [CustomerController::class, 'blog'])->name('customers.blog');
Route::get('/contact', [CustomerController::class, 'contact'])->name('customers.contact');



