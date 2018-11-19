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
Route::delete('/cart_item/{id}', 'CartController@removeItem');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index');
