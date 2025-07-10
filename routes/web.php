<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use PHPUnit\Framework\Attributes\Group;

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

Route::get('/projects/{type}', [CustomerController::class, 'projectIndex'])->name('projects.index');

Route::group(['prefix' => 'price'], function () {
   Route::get('/full', [CustomerController::class, 'priceFull'])->name('price.full');
   Route::get('/raw', [CustomerController::class, 'priceRaw'])->name('price.raw');
   Route::get('/design', [CustomerController::class, 'priceDesign'])->name('price.design');
   Route::get('/permit', [CustomerController::class, 'pricePermit'])->name('price.permit');
});

Route::get('/consultant', [CustomerController::class, 'consultant'])->name('customers.consultant');
Route::get('/blog', [CustomerController::class, 'blog'])->name('customers.blog');
Route::get('/contact', [CustomerController::class, 'contact'])->name('customers.contact');


// Auth
// Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
//    Route::get('login', [AuthController::class, 'login'])->name('login');
//    Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');

//    Route::get('register', [AuthController::class, 'register'])->name('register');
//    Route::post('register', [AuthController::class, 'processRegister'])->name('process_register');
// });


//Admin
Route::group([
   // 'middleware' => CheckLoginMiddleware::class,
], function () {
   
   Route::get('logout',[AuthController::class, 'logout'])->name('logout');

   Route::resource('portfolios', PortfolioController::class)->except([
      'show',
      'destroy',
   ]);

   
   Route::group([
      // 'middleware' => App\Http\Middleware\CheckSuperAdminMiddleware::class,
   ], function () {
      
      Route::delete('portfolios/{portfolio}', [PortfolioController::class, 'destroy']) ->name('portfolios.destroy');
   });

});