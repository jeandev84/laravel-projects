<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;


/**
 *
*/
class DashboardController extends Controller
{
     public function index()
     {
         $posts_count = Post::all()->count();

         return view('admin.dashboard.index', [
             'posts_count' => $posts_count
         ]);
     }
}
