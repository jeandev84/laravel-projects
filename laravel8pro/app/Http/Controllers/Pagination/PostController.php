<?php

namespace App\Http\Controllers\Pagination;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

     public function index(Request $request)
     {
          $posts = Post::paginate(5);

          if ($request->ajax()) {

              $renderHtml = view('pagination.ajax.posts.list', compact('posts'))->render();

              return response()->json(['html' => $renderHtml]);
          }

          return view('pagination.posts.index', compact('posts'));
     }
}
