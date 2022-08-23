<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
     public function index()
     {
         $name = "John";

         $users = ["name" => "John", "email" => "john@gmail.com", "phone" => "1234567890"];

         return view('user', compact('name', 'users'));
     }
}
