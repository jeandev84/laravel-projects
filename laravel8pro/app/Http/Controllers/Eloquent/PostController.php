<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

      public function list()
      {
          // $posts = Post::orderBy('id', 'desc')->get();
          $posts = Post::orderBy('id', 'desc')->paginate(Post::PerPage);

          return view('post.list', compact('posts'));
      }



      public function add()
      {
           return view('post.add');
      }


      public function create(Request $request)
      {
          Post::create($request->only('title', 'body'));

          return back()->with('post_created', 'Post has been created successfully');
      }


      public function show($id)
      {
           $post = Post::where('id', $id)->first();

           return view('post.show', compact('post'));
      }



    public function edit($id)
    {
        $post = Post::find($id);

        return view('post.edit', compact('post'));
    }


    public function update(Request $request, $id)
     {
        $post = Post::find($id);
        $post->update($request->only('title', 'body'));

        return back()->with('post_updated', 'Post has been updated successfully');
     }



     public function delete($id)
     {
         Post::where('id', $id)->delete();

         return back()->with('post_deleted', 'Post has been deleted successfully!');
     }
}
