<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerHomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConsultingRequestController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MediaProxyController;
use App\Http\Middleware\CheckSuperAdminMiddleware;


Route::get('/', [CustomerHomeController::class, 'index'])->name('customers.index');

// Media proxy route for serving images (local or Cloudinary)
Route::get('/media/{media}', [MediaProxyController::class, 'serve'])->name('media.serve');

Route::group(['prefix' => ''], function () {
    Route::get('/anphu', [CustomerController::class, 'aboutAnphu'])->name('about.anphu');
    Route::get('/thu-ngo', [CustomerController::class, 'aboutOpenLetter'])->name('about.open_letter');
    Route::get('/gia-tri-van-hoa', [CustomerController::class, 'aboutCulturalValues'])->name('about.cultural_values');
});

Route::get('/dich-vu/{slug}', [CustomerController::class, 'serviceDetail'])->name('customers.service.detail');
Route::get('/bao-gia/{slug}', [CustomerController::class, 'servicePrice'])->name('customers.service.price');
Route::get('/chinh-sach', [CustomerController::class, 'policyDetail'])->name('customers.policy.detail');

Route::get('/du-an/danh-muc/{slug}', [CustomerController::class, 'projectByCategory'])
    ->name('projects.byCategory');
Route::get('/du-an/{slug}', [CustomerController::class, 'projectDetail'])
->name('customers.project.detail');

Route::get('/bai-dang/danh-muc/{slug}', [CustomerController::class, 'blogIndex'])
->name('customers.blog.index');
Route::get('/bai-dang/{slug}', [CustomerController::class, 'blogDetail'])
->name('customers.blog.detail');

Route::get('/consultant', [CustomerController::class, 'consultant'])
->name('customers.consultant');

Route::get('/contact', [CustomerController::class, 'contact'])
->name('customers.contact');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'processLogin'])->name('process_login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('process_register');
});

Route::post('/consulting-requests/store', [ConsultingRequestController::class, 'store'])->name('consulting_requests.store');
Route::post('/consulting-request/callback', [ConsultingRequestController::class, 'callbackRequest'])
   ->name('consulting_requests.callback');


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
      ->name('media.uploadImage');


   Route::resource('categories', CategoryController::class)->except([
      'destroy'
   ]);

   Route::resource('partners', PartnerController::class)->except([
      'destroy'
   ]);

   Route::resource('services', ServiceController::class)->except([
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
      Route::get('company/', [CompanySettingController::class, 'edit'])->name('company.edit');
      Route::put('company/', [CompanySettingController::class, 'update'])->name('company.update');
      Route::get('company/policy', [CompanySettingController::class, 'editPolicy'])->name('company.editPolicy');
      Route::put('company/policy', [CompanySettingController::class, 'updatePolicy'])->name('company.updatePolicy');
      Route::post('company/policy/check-password', [CompanySettingController::class, 'checkAdminPassword'])->name('company.updatePolicy.checkPassword');
   });

   Route::middleware(CheckSuperAdminMiddleware::class)->group(function () {
      Route::delete('portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');
      Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
      Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
      Route::delete('partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');
      Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

      Route::resource('users', UserController::class);

      // Route::resource('prices', PriceController::class);
   });

});