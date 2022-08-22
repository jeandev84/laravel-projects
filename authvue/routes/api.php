<?php

use Illuminate\Http\Request;

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');

    Route::get('me', 'MeController');

});
