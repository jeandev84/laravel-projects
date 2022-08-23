<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


/**
 *
*/
class FluentController extends Controller
{

       public function index()
       {
           echo "<h1>Fluent Strings</h1>";

           $sliceWord = Str::of('Welcome to my website')
                       ->after('Welcome to');

           echo $sliceWord . '<br>'; // my website


           $sliceWhereSlashes = Str::of('App\Http\Controllers\Controller')
                         ->afterLast('\\');

           echo $sliceWhereSlashes .'<br>'; // Controller


           $appendToString = Str::of('Hello')->append('World!');

           echo $appendToString . '<br>'; // HelloWorld!


           $stringToLower = Str::of('LARAVEL 8')->lower();
           echo $stringToLower . '<br>'; // laravel 8


           $replaced = Str::of('Laravel 7.0')->replace('7.0', '8.0');
           echo $replaced .'<br>'; // Laravel 8.0


           $converted = Str::of('this is a title')->title();
           echo $converted .'<br>'; // This Is A Title

           $slug = Str::of('Laravel 8 Framework')->slug('-');
           echo $slug .'<br>'; // laravel-8-framework


           $substr1 = Str::of('Laravel Framework')->substr(8);
           echo $substr1 . '<br>'; // Framework


           $substr2 = Str::of('Laravel Framework')->substr(8, 5);
           echo $substr2. '<br>'; // Frame


           $trimmed = Str::of('/Laravel8/')->trim('/');
           echo $trimmed .'<br>'; // Laravel8

           $uppercase = Str::of('laravel 8')->upper();
           echo $uppercase .'<br>'; // LARAVEL 8
       }



       protected function displayFluentHeaders()
       {
            echo "<h1>Fluent Strings</h1>";
       }
}
