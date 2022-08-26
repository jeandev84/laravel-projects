<?php
namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
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
