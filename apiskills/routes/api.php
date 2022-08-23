<?php

use App\Http\Controllers\Api\V1\DeviceController;
use App\Http\Controllers\Api\V1\DummyController;
use App\Http\Controllers\Api\V1\FileController;
use App\Http\Controllers\Api\V1\MemberController;
use App\Http\Controllers\Auth\LoginController;
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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::group(['prefix' => 'v1', 'namespace' => 'V1'], function () {
      /* Route::get('dummy', [DummyController::class, 'index']); */
      /* Route::get('/devices/{id?}', [DeviceController::class, 'getListWithOptionalParams']); */
      /* Route::get('/devices', [DeviceController::class, 'list']); */
      /* Route::get('/devices/{id}', [DeviceController::class, 'show']); */

      Route::get('dummy', [DummyController::class, 'index']);
      Route::get('/devices/{id?}', [DeviceController::class, 'getListWithOptionalParams']);
      Route::post('/devices/create', [DeviceController::class, 'create']);
      Route::put('/devices/{id}', [DeviceController::class, 'update']);
      Route::delete('/devices/{id}', [DeviceController::class, 'delete']);
      Route::get('/search/{name}', [DeviceController::class, 'search']);
      Route::post('/devices/save', [DeviceController::class, 'save']);

      Route::apiResource("member", MemberController::class);

      Route::post('/upload', [FileController::class, 'upload']);
});


Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
     Route::post("login", [LoginController::class, 'index']);
});
