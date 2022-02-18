<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
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
    Route::post('/Update/Admin/info', [AdminController::class, 'changePassword'])->name('updatePassword');
});

Route::group(['middleware' => 'auth'], function () {
    //Customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('customers');
    Route::get('/customer/edit/{customerId}', [CustomerController::class, 'edit'])->name('editCustomer');
    Route::post('/customer/update/{customerId}', [CustomerController::class, 'update'])->name('updateCustomer');
    Route::post('/customer', [CustomerController::class, 'store'])->name('addCustomer');

    //Product
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/store/Product', [ProductController::class, 'store'])->name('storeProduct');
    Route::post('/update/Product/{productId}', [ProductController::class, 'update'])->name('updateProduct');
    Route::get('/edit/Product/{productId}', [ProductController::class, 'edit'])->name('editProduct');

    //Order
    Route::get('/order');

    //Invoice
    Route::get('/invoice');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
