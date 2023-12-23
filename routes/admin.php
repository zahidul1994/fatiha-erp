<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SetupController;
Route::group([
  'as' => 'admin.',
  'prefix' => 'admin',
  'middleware' => ['auth', 'admin']
], function () {
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('login-superadmin/{id}', [DashboardController::class, 'loginSuperAdmin'])->name('loginSuperAdmin');
 ##user

Route::get('business-setup', [SetupController::class, 'businessSetup'])->name('businessSetup');
Route::post('business-setup-update', [SetupController::class, 'businessSetupUpdate'])->name('businessSetupUpdate');

##profile
Route::get('profiles', [ProfileController::class, 'index'])->name('profiles');
Route::post('profile-update', [ProfileController::class, 'profilesUpdate'])->name('profilesUpdate');
Route::post('password-update', [ProfileController::class, 'passwordUpdate'])->name('passwordUpdate');
Route::post('software-rating', [ProfileController::class, 'softwareRating'])->name('softwareRating');


##shop
Route::resource('shops', ShopController::class);
Route::post('shop-status', [ShopController::class, 'updateStatus'])->name('shopStatus');
Route::get('shop-pdf/{id}', [ShopController::class, 'shopPdf'])->name('shopPdf');

## wallet
Route::resource('wallets', WalletController::class);
## payment
Route::get('payments',[PaymentController::class, 'index'])->name('payments');
Route::post('payments-create', [PaymentController::class, 'create'])->name('paymentsCreate');
Route::post('payments', [PaymentController::class, 'store'])->name('paymentsStore');
Route::get('invoice-download/{id}', [WalletController::class, 'downloadInvoice'])->name('downloadInvoice');
##common
  include __DIR__ . '/common.php';
});
