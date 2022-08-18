<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


/**
 *
*/
class LogoutController extends Controller
{

     public function index()
     {
         Auth::logout();
         return response(null, Response::HTTP_NO_CONTENT);
     }
}
