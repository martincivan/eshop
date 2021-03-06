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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/cart_item', 'CartController@addItem');
//Route::delete('/cart_item/{id}', 'CartController@removeItem');

Route::get('/products/list/{page}', 'ProductController@list');
Route::get('/products/{id}', 'ProductController@show');
Route::post('/products/{id}/_update', 'ProductController@update');
Route::delete('/products/{id}', 'ProductController@destroy');
Route::post('/products/', 'ProductController@create');


Route::get('/materials/list', 'MaterialController@list');
Route::get('/categories/list', 'CategoryController@list');
