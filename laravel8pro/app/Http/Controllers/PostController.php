<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



/**
 *
*/
class PostController extends Controller
{

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
            $post = DB::table('posts')->where('id', $id)->get();

            return view('posts.show', compact('post'));
       }



      public function update(Request $request, $id)
      {

      }



      public function delete($id)
      {
          DB::table('posts')->where('id', $id)->delete();

          return back()->with('post_deleted', 'Post has been deleted successfully');
      }
}
