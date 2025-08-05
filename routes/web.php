<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerHomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConsultingRequestController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckSuperAdminMiddleware;

Route::get('/test-cloudinary', function () {
    dd(config('cloudinary'));
});

Route::get('/', [CustomerHomeController::class, 'index'])->name('customers.index');

Route::group(['prefix' => 'about'], routes: function () {
   Route::get('/anphu', [CustomerController::class, 'aboutAnphu'])->name('about.anphu');
   Route::get('/open-letter', [CustomerController::class, 'aboutOpenLetter'])->name('about.open_letter');
   Route::get('/cultural-values', [CustomerController::class, 'aboutCulturalValues'])->name('about.cultural_values');

});

Route::group(['prefix' => 'services'], function () {
   Route::get('/construction-full', [CustomerController::class, 'servicesContructionFull'])->name('services.construction_full');
   Route::get('/design-architect', [CustomerController::class, 'servicesDesignArchitect'])->name('services.design_architect');
   Route::get('/design-interior', [CustomerController::class, 'servicesDesignInterior'])->name('services.design_interior');
   Route::get('/construction-renovate', [CustomerController::class, 'servicesContructionRenovate'])->name('services.construction_renovate');
});

Route::get('/du-an/danh-muc/{slug}', [CustomerController::class, 'projectByCategory'])
    ->name('projects.byCategory');

Route::get('/du-an/{slug}', [CustomerController::class, 'projectDetail'])->name('customers.project.detail');

Route::get('/bai-dang/danh-muc/{slug}', [CustomerController::class, 'blogIndex'])
    ->name('blogs.index');

Route::get('/bai-dang/{slug}', [CustomerController::class, 'blogDetail'])->name('customers.blog.detail');

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
Route::prefix('admin')->name('admin.')
    ->middleware('auth')
    ->group(function () {

   Route::get('logout', [AuthController::class, 'logout'])->name('auths.logout');

   Route::resource('portfolios', PortfolioController::class)->except([
      'destroy'
   ]);

   Route::resource('articles', ArticleController::class)->except([
      'destroy'
   ]);

   Route::post('/media/upload-image', [MediaController::class, 'uploadImage'])
      ->middleware(['throttle:10,1'])
      ->name('media.uploadImage');


   Route::resource('categories', CategoryController::class)->except([
      'destroy'
   ]);

   Route::resource('partners', PartnerController::class)->except([
      'destroy'
   ]);

   Route::get('consulting-requests/index', [ConsultingRequestController::class, 'index'])
   ->name('consulting_requests.index');

   Route::put('consulting-requests/edit', [ConsultingRequestController::class, 'edit'])
   ->name('consulting_requests.edit');

   Route::delete('consulting-requests/{id}', [ConsultingRequestController::class, 'destroy'])
   ->name('consulting_requests.destroy');

   Route::patch('consulting-requests/{id}/status', [ConsultingRequestController::class, 'updateStatus'])
   ->name('consulting_requests.updateStatus');

    Route::prefix('settings')->name('settings.')->group(function () {
      Route::get('company', [CompanySettingController::class, 'edit'])->name('company.edit');
      Route::put('company', [CompanySettingController::class, 'update'])->name('company.update');
   });

   Route::middleware(CheckSuperAdminMiddleware::class)->group(function () {
      Route::delete('portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');
      Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
      Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
      Route::delete('partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');

      Route::resource('users', UserController::class);

      // Route::resource('prices', PriceController::class);
   });

   

});