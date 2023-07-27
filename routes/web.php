<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/countrys', 'App\Http\Controllers\JoinTableController@index')->name('countrys');
Route::get('/productlist', 'App\Http\Controllers\SessionCartController@index')->name('productlist');
Route::get('/cartlist', 'App\Http\Controllers\SessionCartController@cartList')->name('cartlist');
Route::post('/session_cart', 'App\Http\Controllers\SessionCartController@addCart')->name('session.cart');
Route::post('/remove_cart_item', 'App\Http\Controllers\SessionCartController@removeCartItem')->name('remove.cart.item');
Route::get('/checkout-view', 'App\Http\Controllers\SessionCartController@checkOutView')->name('checkout.view');
Route::post('/checkout-view', 'App\Http\Controllers\SessionCartController@saveOrderItems')->name('save.order');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/admin-dashboard', [App\Http\Controllers\HomeController::class, 'adminDashboard'])->name('admin.dashboard');
