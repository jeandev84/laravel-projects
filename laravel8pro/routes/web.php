<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FluentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');


# Client Routes
Route::get('/client/posts', [ClientController::class, 'getAllPosts'])
    ->name('client.posts.get_all');

Route::get('/client/post/{id}', [ClientController::class, 'getPostById'])
     ->name('client.post.get_by_id');


Route::get('/client/add-post', [ClientController::class, 'addPost'])
    ->name('client.posts.add');


Route::get('/client/update-post', [ClientController::class, 'updatePost'])
    ->name('client.posts.update');


Route::get('/client/delete-post/{id}', [ClientController::class, 'deletePost'])
    ->name('client.posts.delete');


# Fluent Strings
Route::get('/fluent-string', [FluentController::class, 'index'])
    ->name('fluent.index');


# HttpRequest and FormRequest
Route::get('/login', [LoginController::class, 'index'])
    ->name('login.index');


Route::post('/login', [LoginController::class, 'submit'])
    ->name('login.submit');

