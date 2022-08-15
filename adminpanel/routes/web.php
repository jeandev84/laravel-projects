<?php

use App\Http\Controllers\Admin\CategoryController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Должен иметь доступ к этой странице только пользователь с ролью 'admin'
/*
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/demo', function () {
        return view('access.demo');
    });
});

Route::group(['middleware' => ['role:admin'], 'prefix' => '/admin_panel'], function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index']); // admin/
});

*/

Route::middleware(['role:admin'])->prefix('/admin_panel')->group(function () {

    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
           ->name('admin.dashboard.index'); // admin_panel/

    Route::resource('/category', CategoryController::class); // admin_panel/category

    /*
    Route::resources([
        'category' => \App\Http\Controllers\Admin\CategoryController::class
    ]);
    */
});
