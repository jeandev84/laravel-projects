<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
     // http://localhost:8000/user?name=John&city=Moscow
     public function index(Request $request)
     {
         // return $request->method(); GET|POST ...
         // return $request->path();  user
         // return $request->url(); http://localhost:8000/user
         // return $request->fullUrl(); http://localhost:8000/user?name=John&city=Moscow
     }


     public function listUsersDemo()
     {
        $name = "John";

        $users = [
            "name" => "John",
            "email" => "john@gmail.com",
            "phone" => "1234567890"
        ];

        return view('user', compact('name', 'users'));
    }



    // http://localhost:8000/user?name=John&city=Moscow
    public function requestDemo(Request $request)
    {
        // return $request->method(); GET|POST ...
        // return $request->path();  user
        // return $request->url(); http://localhost:8000/user
        // return $request->fullUrl(); http://localhost:8000/user?name=John&city=Moscow
    }
}
