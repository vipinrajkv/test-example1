<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/orders_list',[App\Http\Controllers\HomeController::class, 'getAllOrders'])->name('orders.list');
Route::get('/orders_view/{id}',[App\Http\Controllers\HomeController::class, 'getOrderDetails'])->name('orders.view');
Route::get('/order_user_data/{id}',[App\Http\Controllers\HomeController::class, 'getOrderUserDetails'])->name('orders.user.details');
Route::post('/add_product',[App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::get('/products-list',[App\Http\Controllers\ProductController::class, 'show'])->name('products-list');
Route::get('/product-view/{id}',[App\Http\Controllers\ProductController::class, 'edit'])->name('product-view');
Route::post('/update-product/{id}',[App\Http\Controllers\ProductController::class, 'update'])->name('update-product');
Route::delete('/delete-product/{id}',[App\Http\Controllers\ProductController::class, 'destroy'])->name('delete-product');