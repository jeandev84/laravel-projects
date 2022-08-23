<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 *
*/
class ProductController extends Controller
{
      public function index()
      {
           $fruits = ['Mango', 'Orange'. 'Banana', 'Apple', 'Pineapple'];

           return view('product.index', compact('fruits'));
      }
}
