<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\User;


use Illuminate\Http\Request;


class PaginationController extends Controller
{

       public function listUsers()
       {
           $users = User::paginate(10);

           return view('users.list', compact('users'));
       }
}
