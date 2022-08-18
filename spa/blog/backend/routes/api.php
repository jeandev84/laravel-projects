<?php

use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('posts', [PostController::class, 'index']);
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'index']);
    Route::delete('logout', [LogoutController::class, 'index']);
});

