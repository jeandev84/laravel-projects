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
