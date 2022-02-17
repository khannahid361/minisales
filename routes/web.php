<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Route::get('/', function () {
//     return view('auth.login');
// });
Route::middleware(['middlware' => 'PreventBackHistory'])->group(function () {
    Auth::routes();
});
//Super Admin
Route::group(['middleware' => ['auth', 'isAdmin', 'PreventBackHistory']], function () {
    Route::get('/Dashboard/super', [SuperAdminController::class, 'dashboard'])->name('adminDashboard');
    Route::post('/Update/super/info', [SuperAdminController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/Index/admin', [SuperAdminController::class, 'index'])->name('adminIndex');
    Route::get('/create/admin', [SuperAdminController::class, 'createAdmin'])->name('createAdmin');
    Route::post('/store/admin', [SuperAdminController::class, 'storeAdmin'])->name('storeAdmin');
});

//Normal admin/User
Route::group(['middleware' => ['auth', 'isUser', 'PreventBackHistory']], function () {
    Route::get('/Dashboard/admin', [AdminController::class, 'dashboard'])->name('userDashboard');
});

Route::group(['middleware' => 'auth'], function () {
    //Customer
    Route::get('/customer');

    //Product
    Route::get('/product');

    //Order
    Route::get('/order');

    //Invoice
    Route::get('/invoice');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
