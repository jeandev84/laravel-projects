<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoController extends Controller
{

      public function getFirstLastName()
      {
           return splitName("Mark John");
      }


      public function useSomeFunctions() {}
}
