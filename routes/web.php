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
Route::post('/save-order', 'App\Http\Controllers\SessionCartController@saveOrder')->name('save.order');

Route::get('/admin-dashboard', [App\Http\Controllers\HomeController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/dashboard-preview', [App\Http\Controllers\HomeController::class, 'adminDashboardPreview'])->name('admin.dashboard.preview');

Route::get('admin/{pathMatch}', function(){
    return view('layouts.backend.adminHome');
})->where('pathMatch',".*");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
