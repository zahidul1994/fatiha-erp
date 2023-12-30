<?php

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BkashController;
use App\Http\Controllers\OnChangeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PublicSslCommerzPaymentController;


// Route::fallback(function () {
//     abort(404);
// });


Route::get('/', [HomeController::class,'index']);


Auth::routes();
Route::group(['prefix' => 'filemanager', 'middleware' => ['auth', 'superadmin']], function () {
    Lfm::   routes();
});


Route::get('/home', [HomeController::class,'index'])->name('home');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [HomeController::class,'register']);
Route::post('register', [HomeController::class,'registerStore'])->name('register');
Route::post('login', [LoginController::class,'login'])->name('login');


##get agent value

##get proudct value
Route::get('get-sub-category/{id}', [OnChangeController::class,'getSubCategory'])->name('getSubCategory');
Route::get('get-supplier-due/{id}', [OnChangeController::class,'getSupplierDue'])->name('getSupplierDue');
Route::get('get-customer-due/{id}', [OnChangeController::class,'getCustomerDue'])->name('getCustomerDue');
Route::get('get-admin-information/{id}', [OnChangeController::class,'getAdminInformation'])->name('getAdminInformation');



// SSLCOMMERZ Start
// buy package
Route::get('/ssl/pay', [PublicSslCommerzPaymentController::class,'index'])->name('ssl.pay');
Route::POST('/success', [PublicSslCommerzPaymentController::class,'success']);
Route::POST('/fail',  [PublicSslCommerzPaymentController::class,'fail']);
Route::POST('/cancel',  [PublicSslCommerzPaymentController::class,'cancel']);
Route::POST('/ipn',  [PublicSslCommerzPaymentController::class,'ipn']);
Route::POST('/ecommercesuccess', [PublicSslCommerzPaymentController::class,'ecommercesuccess']);
Route::POST('/ecommercefail',  [PublicSslCommerzPaymentController::class,'ecommercefail']);
Route::POST('/ecommercecancel',  [PublicSslCommerzPaymentController::class,'ecommercecancel']);

//SSLCOMMERZ END

Route::get('/ssl/redirect/{trans_id}',[PublicSslCommerzPaymentController::class,'status']);



// bkash
Route::get('/pay', [BkashController::class, 'pay'])->name('pay');
Route::post('/bkash/create', [BkashController::class, 'create'])->name('create');
Route::post('/bkash/execute', [BkashController::class, 'execute'])->name('execute');
Route::get('/bkash/success', [BkashController::class, 'success'])->name('success');
Route::get('/bkash/fail', [BkashController::class, 'fail'])->name('fail');

//contact

Route::post('/contact',  [HomeController::class,'contactStore'])->name('contactStore');
