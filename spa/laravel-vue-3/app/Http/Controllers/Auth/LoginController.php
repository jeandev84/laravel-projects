<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

       public function index(Request $request)
       {
             if (Auth::attempt($request->only('email', 'password'))) {
                 $success = true;
                 $message = "User login successfully";
             } else {
                 $success = false;
                 $message = "Unauthorised";
             }

             $response = [
                 'success' => $success,
                 'message' => $message
             ];

             return response()->json($response);
       }
}
