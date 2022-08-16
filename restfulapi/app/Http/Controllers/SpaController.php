<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * Single Page Application
 *
 * Entry point front
*/
class SpaController extends Controller
{
      public function index()
      {
           return view('spa.index');
      }
}
