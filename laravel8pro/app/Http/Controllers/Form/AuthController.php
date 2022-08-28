<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
       public function index()
       {
            return view('form.auth.register');
       }


       public function registerSubmit(Request $request)
       {
             return "Form Submitted Successfully";
       }
}
