### HTTP Client 

- https://jsonplaceholder.typicode.com/
```

==========================================================
           CLIENT CONTROLLER
=========================================================

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


/**
 *
*/
class ClientController extends Controller
{
      public function getAllPosts()
      {
           $posts = Http::get('https://jsonplaceholder.typicode.com/posts');
           return $posts->json();
      }


      public function getPostById($id)
      {
           $post = Http::get("https://jsonplaceholder.typicode.com/posts/{$id}");

           return $post->json();
      }



      public function addPost(Request $request)
      {
          /*
           $post = Http::post("https://jsonplaceholder.typicode.com/posts", [
              'userId' => 1,
              'title'  => 'New Post Title',
              'body'   => 'New Post Description'
          ]);
          */

          // https://jsonplaceholder.typicode.com/posts?userId=1&title='New Post Title'&body="..."
          $post = Http::post("https://jsonplaceholder.typicode.com/posts", $request->all());

          return $post->json();
      }



      public function updatePost(Request $request)
      {
            /*
              $response = Http::put("https://jsonplaceholder.typicode.com/posts/1", [
                  'title' => 'Updated Title',
                  'body'  => 'Updated Description'
              ]);
            */

            $response = Http::put("https://jsonplaceholder.typicode.com/posts/{$request->id}", $request->all());

            return $response->json();
      }


      public function deletePost($id)
      {
         $response = Http::delete("https://jsonplaceholder.typicode.com/posts/{$id}");

         return $response->json();
     }
}


========================================================================
                        CLIENT ROUTES
========================================================================



Route::get('/client/posts', [ClientController::class, 'getAllPosts'])
    ->name('client.posts.get_all');

Route::get('/client/post/{id}', [ClientController::class, 'getPostById'])
     ->name('client.post.get_by_id');


Route::get('/client/add-post', [ClientController::class, 'addPost'])
    ->name('client.posts.add');


Route::get('/client/update-post', [ClientController::class, 'updatePost'])
    ->name('client.posts.update');


Route::get('/client/delete-post/{id}', [ClientController::class, 'deletePost'])
    ->name('client.posts.delete');
     

```
