<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FluentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
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
    ->name('login.index')->middleware('check.user');


Route::post('/login', [LoginController::class, 'submit'])
    ->name('login.submit');


# Http Session
Route::get('/session/get', [SessionController::class, 'getSessionData'])
    ->name('session.get');


Route::get('/session/set', [SessionController::class, 'storeSessionData'])
    ->name('session.store');


Route::get('/session/remove', [SessionController::class, 'deleteSessionData'])
    ->name('session.delete');


# Posts (CRUD)
Route::get('/posts', [PostController::class, 'list'])->name('posts.list');
Route::get('/post/add', [PostController::class, 'add'])->name('post.add');
Route::post('/post/add', [PostController::class, 'submit'])->name('post.submit');
Route::get('/post/show/{id}', [PostController::class, 'show'])->name('post.show');
Route::get('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::post('/post/edit/{id}', [PostController::class, 'update'])->name('post.update');


