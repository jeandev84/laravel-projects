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

Route::get('/', 'HomeController@index', 'home');

// Каждый товар хранится в какой-то категории (путь к продукту)
//  Route::get('/{category_id}/{product_id}', 'ProductController@show')->where('id', '\d+');

Route::get('/{category}/{product_id}', 'ProductController@show');

