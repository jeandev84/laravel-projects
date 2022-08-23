### Controllers

1. Make Controller
```php 
$ php artisan make:controller HomeController 


Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/contact/{name}', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/optianal/{name?}', [HomeController::class, 'optional'])->name('home.optional');


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
      public function index()
      {
           return "Home Page";
      }


      public function contact($name)
      {
           return "Hello, $name";
      }

      public function optional($name = null)
      {
         return $name ? "Hello, $name" : "Hello";
      }
}


```
