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

/*

Каждый товар хранится в какой-то категории (путь к продукту)
Route::get('/{category_id}/{product_id}', 'ProductController@show')->where('id', '\d+');
*/



// Маршрут для вывода главной страницы
Route::get('/', 'HomeController@index', 'home');


// Маршрут для просмотра категории
Route::get('/{category_alias}', 'ProductController@showCategory')->name('show.category');


// Маршрут для просмотра одного продукта
Route::get('/{category}/{product_id}', 'ProductController@show')->name('show.product');






