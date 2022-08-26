<?php

use App\Http\Controllers\Demo\ClientController;
use App\Http\Controllers\Demo\FluentController;
use App\Http\Controllers\Demo\LoginController;
use App\Http\Controllers\Demo\MailController;
use App\Http\Controllers\Demo\PaginationController;
use App\Http\Controllers\Demo\PostController;
use App\Http\Controllers\Demo\ProductController;
use App\Http\Controllers\Demo\SessionController;
use App\Http\Controllers\Demo\UploadController;
use App\Http\Controllers\Demo\UserController;
use App\Http\Controllers\Eloquent\StudentController;
use App\PaymentGateway\Payment;
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
Route::get('/auth/login', [LoginController::class, 'index'])
    ->name('login.index')->middleware('check.user');


Route::post('/auth/login', [LoginController::class, 'submit'])
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

# Join Clause
Route::get('/posts/inner-join', [PostController::class, 'innerJoinClause'])->name('post.inner.join');
Route::get('/posts/left-join', [PostController::class, 'leftJoinClause'])->name('post.left.join');
Route::get('/posts/right-join', [PostController::class, 'rightJoinClause'])->name('post.right.join');


# Models
Route::get('/all-posts', [PostController::class, 'getAllPostsUsingModel'])->name('posts.all');


# Blade Template
Route::get('/blade', function () {
     return view('blade.index');
})->name('blade.index');

# Layout blade
Route::get('/home', function () {
     return view('pages.index');
})->name('page.home');


Route::get('/about', function () {
    return view('pages.about');
})->name('page.about');


Route::get('/contact', function () {
    return view('pages.contact');
})->name('page.contact');


# Pagination
Route::get('/users', [PaginationController::class, 'listUsers'])->name('pagination.users');


# Upload File
Route::get('/upload', [UploadController::class, 'uploadForm'])->name('upload.form');
Route::post('/upload', [UploadController::class, 'uploadFile'])->name('upload.file');


# Localization
Route::get('/{locate}/lang', function ($locate) {

    App::setLocale($locate);

    return view('localization.index');

})->name('locate.page');


# Facades (PaymentGateway)

Route::get('/payment', function () {

    return Payment::process();
});


# Send Mail

Route::get('/send-mail', [MailController::class, 'sendEmail'])->name('send.mail');


# JetStream Auth
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


# Eloquent
Route::get('/students', [StudentController::class, 'fetchStudents']);
