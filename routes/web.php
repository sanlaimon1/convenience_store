<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('category', 'App\Http\Controllers\CategoryController');

Route::resource('brand', 'App\Http\Controllers\BrandController');

Route::resource('product', 'App\Http\Controllers\ProductController');

Route::resource('stock', 'App\Http\Controllers\StockController');

Route::resource('customer', 'App\Http\Controllers\CustomerController');

Route::resource('staff', 'App\Http\Controllers\StaffController');

Route::resource('store', 'App\Http\Controllers\StoreController');

Route::resource('order', 'App\Http\Controllers\OrderController');

Route::resource('order_item', 'App\Http\Controllers\OrderItemController');
