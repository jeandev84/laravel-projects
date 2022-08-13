<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * HomeController
*/
class HomeController extends Controller
{

       /**
        * Route '/'
       */
       public function index()
       {
           return view('home.index');
       }
}
