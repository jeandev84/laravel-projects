<?php

use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Auth\AuthController;
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


# API routes version 1 :
Route::group(['prefix' => 'v1', 'middleware' => 'sanctum'], function () {
    Route::apiResources([
        'posts' => PostController::class
    ]);
});


# Auth controller
Route::group(['prefix' => 'auth'], function () {
     Route::post('/register', [AuthController::class, 'register']);
     Route::post('/login', [AuthController::class, 'login']);
     Route::post('/logout', [AuthController::class, 'logout'])
           ->middleware('sanctum');
});



/*
Route::prefix('v1')->group(function () {

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/post', [PostController::class, 'store']);
    Route::get('/post/{post}', [PostController::class, 'show']);
    Route::put('/post/{post}', [PostController::class, 'update']);
    Route::delete('/post/{post}', [PostController::class, 'delete']);

});

*/
