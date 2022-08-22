<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SignOutController extends Controller
{

    public function __invoke()
    {
         auth()->logout();

         return response(null, Response::HTTP_NO_CONTENT);
    }
}
