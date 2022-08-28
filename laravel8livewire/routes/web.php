<?php

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

Route::get('/', function () {
    return view('welcome');
});


# Livewire components routes
Route::get('/post', \App\Http\Livewire\Post::class);
Route::get('/user', \App\Http\Livewire\User::class);
Route::get('/home/{name?}', \App\Http\Livewire\Home::class);
Route::get('/form', \App\Http\Livewire\Form::class);
Route::get('/actions', \App\Http\Livewire\Action::class);
Route::get('/product', \App\Http\Livewire\Product::class);
