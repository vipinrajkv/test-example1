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
    // return $request->user();
Route::post('/add_product',[App\Http\Controllers\ProductController::class, 'create'])->name('product.create');

});

//Order
Route::get ('/orders_list',[App\Http\Controllers\HomeController::class, 'getAllOrders'])->name('orders.list');
Route::get('/orders_view/{id}',[App\Http\Controllers\HomeController::class, 'getOrderDetails'])->name('orders.view');
Route::get('/order_user_data/{id}',[App\Http\Controllers\HomeController::class, 'getOrderUserDetails'])->name('orders.user.details');
//Product
Route::get('/products-list',[App\Http\Controllers\ProductController::class, 'show'])->name('products-list');
Route::get('/product-view/{id}',[App\Http\Controllers\ProductController::class, 'edit'])->name('product-view');
Route::post('/update-product/{id}',[App\Http\Controllers\ProductController::class, 'update'])->name('update-product');
Route::delete('/delete-product/{id}',[App\Http\Controllers\ProductController::class, 'destroy'])->name('delete-product');
//Category
Route::post('/add-category',[App\Http\Controllers\CategoryController::class, 'create'])->name('add-category');
Route::get('/get-category-list',[App\Http\Controllers\CategoryController::class, 'show'])->name('get-category-list');
Route::get('/get-category/{id}',[App\Http\Controllers\CategoryController::class, 'edit'])->name('get-category');
Route::post('/update-category/{id}',[App\Http\Controllers\CategoryController::class, 'update'])->name('update-category');
Route::delete('/delete-category/{id}',[App\Http\Controllers\CategoryController::class, 'destroy'])->name('delete-category');
//Sub Category
Route::post('/add-subcategory',[App\Http\Controllers\SubCategoryController::class, 'create'])->name('add-subcategory');
Route::get('/get-subcategory-list',[App\Http\Controllers\SubCategoryController::class, 'show'])->name('get-subcategory-list');
Route::get('/get-subcategory/{id}',[App\Http\Controllers\SubCategoryController::class, 'edit'])->name('get-subcategory');
Route::post('/update-subcategory/{id}',[App\Http\Controllers\SubCategoryController::class, 'update'])->name('update-subcategory');
Route::delete('/delete-subcategory/{id}',[App\Http\Controllers\SubCategoryController::class, 'destroy'])->name('delete-subcategory');


Route::post('/authlogin', [App\Http\Controllers\HomeController::class, 'login']);