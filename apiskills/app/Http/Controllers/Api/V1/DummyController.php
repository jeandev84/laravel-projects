<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DummyController extends Controller
{
     public function index()
     {
          return [
              'name' => 'Brown',
              'email' => 'brown@gmail.com',
              'address' => 'Moscow, street golovinskoe shosse dom 8 k 2a'
          ];
     }
}
