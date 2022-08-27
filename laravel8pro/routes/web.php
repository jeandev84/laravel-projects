<?php

use App\Http\Controllers\Demo\ClientController;
use App\Http\Controllers\Demo\FluentController;
use App\Http\Controllers\Demo\LoginController;
use App\Http\Controllers\Demo\MailController;
use App\Http\Controllers\Demo\PaginationController;
//use App\Http\Controllers\Demo\PostController;
use App\Http\Controllers\Eloquent\PostController;
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

/*
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

# Eloquent CRUD
Route::get('/posts', [PostController::class, 'list'])->name('post.list');
Route::get('/post/add', [PostController::class, 'add'])->name('post.add');
Route::post('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::post('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
Route::get('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');



# Eloquent RelationShip (OneToOne)
Route::get('/add-user', [\App\Http\Controllers\Eloquent\RelationShip\OneToOne\UserController::class, 'insertRecord'])
    ->name('user.insertRecord');


Route::get('/get-phone/{id}', [\App\Http\Controllers\Eloquent\RelationShip\OneToOne\UserController::class, 'fetchPhoneByUserId'])
    ->name('user.fetchByUser');


# Eloquent RelationShip (OneToMany)
Route::get('/add-post', [\App\Http\Controllers\Eloquent\RelationShip\OneToMany\PostController::class, 'addPost'])
    ->name('post.add');

Route::get('/add-comment/{postId}', [\App\Http\Controllers\Eloquent\RelationShip\OneToMany\PostController::class, 'addComment'])
    ->name('post.add.comment');

Route::get('/get-comments/{postId}', [\App\Http\Controllers\Eloquent\RelationShip\OneToMany\PostController::class, 'getCommentsByPostId'])
    ->name('post.get.comments');


# Eloquent RelationShip (ManyToMany)
Route::get('/add-roles', [\App\Http\Controllers\Eloquent\RelationShip\ManyToMany\RoleController::class, 'addRoles'])
    ->name('add.roles');


Route::get('/add-user-and-roles', [\App\Http\Controllers\Eloquent\RelationShip\ManyToMany\RoleController::class, 'addUser'])
    ->name('add.user.and.roles');


Route::get('/get-roles-by-user/{userId}', [\App\Http\Controllers\Eloquent\RelationShip\ManyToMany\RoleController::class, 'getAllRolesByUserId'])
    ->name('get.roles.by_user');


Route::get('/get-users-by-role/{roleId}', [\App\Http\Controllers\Eloquent\RelationShip\ManyToMany\RoleController::class, 'getAllUsersByRoleId'])
    ->name('get.roles.by_role');


# Export CSV Data
Route::get('/add-employees', [\App\Http\Controllers\CSV\EmployeeController::class, 'addEmployee'])
    ->name('add.employees');


Route::get('/export-excel', [\App\Http\Controllers\CSV\EmployeeController::class, 'exportIntoExcel'])
    ->name('export.excel');


Route::get('/export-csv', [\App\Http\Controllers\CSV\EmployeeController::class, 'exportIntoCSV'])
    ->name('export.csv');


# Export PDF
Route::get('/get-all-employees', [\App\Http\Controllers\PDF\EmpController::class, 'getAllEmployees'])
    ->name('get.all.employees');


Route::get('/download-pdf-employees', [\App\Http\Controllers\PDF\EmpController::class, 'downloadPDF'])
    ->name('download.pdf.employees');


# Import CSV
Route::get('/import-form', [\App\Http\Controllers\CSV\EmployeeController::class, 'importForm'])
    ->name('import.form');


Route::post('/import-csv', [\App\Http\Controllers\CSV\EmployeeController::class, 'importCSV'])
    ->name('import.csv');


# Resize Image
Route::get('/resize-image', [\App\Http\Controllers\Image\ImageController::class, 'resizeImageForm'])
    ->name('resize.image.form');


Route::post('/resize-image', [\App\Http\Controllers\Image\ImageController::class, 'resizeImageSubmit'])
    ->name('resize.image.submit');


# DropZoneJS File Upload
Route::get('/dropzone-image', [\App\Http\Controllers\Image\DropZoneJSFileUploadController::class, 'dropzoneForm'])
    ->name('dropzone.form');


Route::post('/dropzone-store', [\App\Http\Controllers\Image\DropZoneJSFileUploadController::class, 'dropzoneStore'])
    ->name('dropzone.store');


# LazyLoading Image
Route::get('/gallery-images', [\App\Http\Controllers\Image\GalleryController::class, 'gallery'])
     ->name('gallery.images');


# TinyMCE ( WYSIWYG HTML Editor )
Route::get('/tinymce-editor', [\App\Http\Controllers\TinyMCE\EditorController::class, 'editor'])
    ->name('tinymce.editor');


# Image CRUD
Route::get('/add-student', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'addStudent'])
   ->name('student.add');


Route::post('/add-student', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'storeStudent'])
    ->name('student.store');


Route::get('/students', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'getStudents'])
    ->name('students.list');


Route::get('/edit-student/{id}', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'editStudent'])
    ->name('student.edit');


Route::post('/update-student/{id}', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'updateStudent'])
    ->name('student.update');


Route::get('/delete-student/{id}', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'deleteStudent'])
    ->name('student.delete');


# Notification Toastr
# Notification Sweet Alert

# Contact Form
Route::get('/contact-us', [\App\Http\Controllers\Form\ContactController::class, 'contactForm'])
    ->name('contact.us');


Route::post('/send-message', [\App\Http\Controllers\Form\ContactController::class, 'sendEmail'])
    ->name('contact.send');


# Helpers functions
Route::get('/get-name', [\App\Http\Controllers\Helpers\DemoController::class, 'getFirstLastName'])
   ->name('get.name');


# Search Autocomplete
Route::get('/add-products', [\App\Http\Controllers\Search\ProductController::class, 'addProducts'])
   ->name('add.products');

Route::get('/search', [\App\Http\Controllers\Search\ProductController::class, 'search'])
    ->name('search');


Route::get('/autocomplete', [\App\Http\Controllers\Search\ProductController::class, 'autocomplete'])
    ->name('autocomplete');


# Zip File Download
Route::get('/zip-download', [\App\Http\Controllers\ZipFile\ZipController::class, 'downloadZipFile'])
   ->name('zip.download');


# DataTables
Route::get('/employees', [\App\Http\Controllers\DataTables\EmployeeController::class, 'index'])
  ->name('employees.list');

*/


# AJAX Records

Route::get('/students', [\App\Http\Controllers\Ajax\StudentController::class, 'index'])
     ->name('students.list');


Route::post('/add-student', [\App\Http\Controllers\Ajax\StudentController::class, 'addStudent'])
    ->name('student.add');

