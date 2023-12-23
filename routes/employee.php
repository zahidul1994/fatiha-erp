<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\ProfileController;
use App\Http\Controllers\Employee\DashboardController;


Route::group(['as'=>'employee.','prefix' =>'employee', 'middleware' => ['auth','employee']], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
##profile 
Route::get('profiles', [ProfileController::class, 'index'])->name('profiles');
Route::post('profile-update', [ProfileController::class, 'profilesUpdate'])->name('profilesUpdate');
Route::post('password-update', [ProfileController::class, 'passwordUpdate'])->name('passwordUpdate');
Route::post('software-rating', [ProfileController::class, 'softwareRating'])->name('softwareRating');

     //common
  include __DIR__ . '/common.php';
});

