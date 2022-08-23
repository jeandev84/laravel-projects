<?php

use App\Http\Controllers\HomeController;
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


/*
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/contact/{name}', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/optianal/{name?}', [HomeController::class, 'optional'])->name('home.optional');


Route::get('/home/{name}', [HomeController::class, 'index'])->name('home.index');

Route::get('/user', function () {
     return view('user');
})->name('user.index');
*/

Route::get('/user', [UserController::class, 'index'])->name('user.index');
