<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
], function () {

    // Home route
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Categories routes
    Route::resource('categories', CategoryController::class)->except('show');

    // Products routes
    Route::resource('products', ProductController::class)->except('show');

    // Clients routes
    Route::resource('clients', ClientController::class)->except('show');    
    Route::resource('clients.orders', App\Http\Controllers\Client\OrderController::class)->except('show');

    // Orders routes
    Route::resource('orders', OrderController::class)->except('show');
    Route::get('orders.products/{order}', [OrderController::class, 'products'])->name('orders.products');

    // Users routes
    Route::resource('users', UserController::class)->except('show');    

    // Roles routes
    Route::resource('roles', RoleController::class)->except('show');

});


require __DIR__.'/auth.php';




