### Routing 
```php 

<?php

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


// api/users
Route::get('/users', function () {
     return [
        ['id' => 1, 'email' => 'user1@gmail.com', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
        ['id' => 2, 'email' => 'user2@gmail.com', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
        ['id' => 3, 'email' => 'user3@gmail.com', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
        ['id' => 4, 'email' => 'user4@gmail.com', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
        ['id' => 5, 'email' => 'user5@gmail.com', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
        ['id' => 6, 'email' => 'user6@gmail.com', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
     ];
});

Route::get('/users/{name}', function ($name) {
     return sprintf('Hi, %s', $name);
});

=========================================================
             Optional parameters:
=========================================================

Route::get('/users/{name?}', function ($name = null) {
     return $name ? sprintf('Hi, %s', $name) : 'Hi!)';
});


Route::get('/users/{name?}', function ($name = null) {
     return $name ? sprintf('Hi, %s', $name) : 'Hi!)';
})->where('name', '[a-zA-Z]+');


Route::get('/products/{id?}', function ($id = null) {
    if(! $id) {
         return [
           ['id' => 1, 'title' => 'Product 1', 'price' => 301, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, veniam.'],
           ['id' => 2, 'title' => 'Product 2', 'price' => 302, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, veniam.'],
           ['id' => 3, 'title' => 'Product 3', 'price' => 303, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, veniam.'],
           ['id' => 4, 'title' => 'Product 4', 'price' => 304, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, veniam.'],
        ];
    }
    
    return [
        'id' => $id, 'title' => 'Product '. $id, 'price' => (300 + $id), 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, veniam.'
    ];
})->where('id', '[0-9]+');



Route::match(['get', 'post'], '/students', function (Request $request) {

    echo "Requested method is [ $request->method() ]";
    
    return [
        ['id' => 1, 'email' => 'student1@gmail.com', 'name' => 'Student 1', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
        ['id' => 2, 'email' => 'student2@gmail.com', 'name' => 'Student 2', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
        ['id' => 3, 'email' => 'student3@gmail.com', 'name' => 'Student 3', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
        ['id' => 4, 'email' => 'student4@gmail.com', 'name' => 'Student 4', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
        ['id' => 5, 'email' => 'student5@gmail.com', 'name' => 'Student 5', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
        ['id' => 6, 'email' => 'student6@gmail.com', 'name' => 'Student 6', 'address' => 'Moscow, golovinskoe shosse dom 8 k 2a'],
    ];
});


// Call by each method GET|POST|PUT|DELETE ...
Route::any('/posts', function (Request $request) {
     return sprintf('Requested method is [ %s ]', $request->method());
});

```
