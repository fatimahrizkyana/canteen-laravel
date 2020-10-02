<?php

use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

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

// Login Route
Route::get('/login', 'AuthController@index')->name('login');
Route::post('/login', 'AuthController@auth')->name('login.auth');
Route::get('/logout', 'AuthController@destroy')->name('logout');

Route::middleware('is.login')->group(function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/canteen-menu', 'CanteenMenuController');
    Route::resource('/table', 'TableController');
    Route::resource('/order', 'OrderController');
    Route::resource('/transaction', 'TransactionController');
    Route::resource('/user', 'UserController');

    Route::get('/transaction/get/data', 'TransactionController@data')->name('transaction.data');
    Route::get('/order/get/data', 'OrderController@data')->name('order.data');
    Route::post('/order/post/done', 'OrderController@done')->name('order.done');
    Route::post('/order/post/cancel', 'OrderController@cancel')->name('order.cancel');
    Route::get('/table/get/data', 'TableController@data')->name('table.data');
    Route::get('/canteen-menu/get/data', 'CanteenMenuController@data')->name('canteen-menu.data');
});


