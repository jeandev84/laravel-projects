<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * Single Page Application
 */
class SpaController extends Controller
{
      public function index()
      {
           return view('index');
      }
}
