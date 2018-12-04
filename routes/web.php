<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'CustomerController@index');
Route::get('/category/{id}', 'CustomerController@category');
Route::get('/product/{id}', 'CustomerController@product');
Route::get('/cart', 'CartController@index');

Route::post('/cart_item', 'CartController@addItem');
Route::put('/cart_item/{id}', 'CartController@changeItemNumber');
Route::delete('/cart_item/{id}', 'CartController@removeItem');

Route::post('/payment', 'OrderController@payment');
Route::post('/order', 'OrderController@create');
Route::get('/shipping', 'OrderController@shipping');


Auth::routes();

Route::get('/admin', 'AdminController@index');
