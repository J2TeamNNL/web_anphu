<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ConsultingRequestController;

use App\Http\Controllers\AuthController;

use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckSuperAdminMiddleware;

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
Route::get('/blogs', [CustomerController::class, 'blogIndex'])->name('blogs.index');

Route::group(['prefix' => 'price'], function () {
   Route::get('/full', [CustomerController::class, 'priceFull'])->name('price.full');
   Route::get('/raw', [CustomerController::class, 'priceRaw'])->name('price.raw');
   Route::get('/design', [CustomerController::class, 'priceDesign'])->name('price.design');
   Route::get('/permit', [CustomerController::class, 'pricePermit'])->name('price.permit');
});

Route::get('/consultant', [CustomerController::class, 'consultant'])->name('customers.consultant');

Route::get('/contact', [CustomerController::class, 'contact'])->name('customers.contact');

Route::group(['prefix' => 'auth'], function () {
   Route::get('/login', [AuthController::class, 'login'])->name('auths.login');
   Route::post('/login', [AuthController::class, 'processLogin'])->name('auths.process_login');
   Route::get('/register', [AuthController::class, 'register'])->name('auths.register');
   Route::post('/register', [AuthController::class, 'processRegister'])->name('auths.process_register');
});

Route::post('/consulting-requests/store', [ConsultingRequestController::class, 'store'])->name('consulting_requests.store');

//Admin
Route::group([
   'middleware' => CheckLoginMiddleware::class, 
],  function () {

   Route::get('auth/logout',[AuthController::class, 'logout'])->name('auths.logout');

   Route::patch('/admin/consulting-requests/{id}/status', [ConsultingRequestController::class, 'updateStatus'])->name('consulting_requests.updateStatus');

   Route::resource('portfolios', PortfolioController::class)->except([
      'show',
      'destroy',
   ]);

   Route::resource('articles', ArticleController::class)->except([
      'show',
      'destroy',
   ]);

   Route::get('/consulting-requests/index', [ConsultingRequestController::class, 'index'])->name('consulting_requests.index');
   Route::put('/consulting-requests/edit', [ConsultingRequestController::class, 'edit'])->name('consulting_requests.edit');

   
   Route::group([
      'middleware' => CheckSuperAdminMiddleware::class,
   ], function () {
      
      Route::delete('portfolios/{portfolio}', [PortfolioController::class, 'destroy']) ->name('portfolios.destroy');
      Route::delete('articles/{article}', [ArticleController::class, 'destroy']) ->name('articles.destroy');

      Route::resource('users', UserController::class);
   });

});