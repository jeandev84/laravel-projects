<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



/**
 *
*/
class PostController extends Controller
{

       public function __construct()
       {
            // resolve Maximum execution time of 60 seconds exceeded in php
            ini_set('max_execution_time', 300);
       }


       public function list()
       {
           $posts = DB::table('posts')->get();

           return view('posts.list', compact('posts'));
       }


       public function add()
       {
           return view('posts.add');
       }



       public function submit(Request $request)
       {
             DB::table('posts')->insert($request->only('title', 'body'));

             return back()->with('post_created', 'Post has been created successfully');
       }



       public function show($id)
       {
            $post = DB::table('posts')->where('id', $id)->first();

            return view('posts.show', compact('post'));
       }



      public function edit($id)
      {
           $post = DB::table('posts')->where('id', $id)->first();

           return view('posts.edit', compact('post'));
      }


     public function update(Request $request, $id)
     {
           DB::table('posts')->where('id', $id)->update($request->only('title', 'body'));

           return back()->with('post_updated', 'Post has been updated successfully');
     }



      public function delete($id)
      {
          DB::table('posts')->where('id', $id)->delete();

          return back()->with('post_deleted', 'Post has been deleted successfully');
      }
}
