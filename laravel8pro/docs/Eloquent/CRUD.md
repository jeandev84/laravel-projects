### CRUD Eloquent 

```php 
$ php artisan make:controller Eloquent/PostController

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
        Post::find($id)->update($request->only('title', 'body'));

        return back()->with('post_updated', 'Post has been updated successfully');
     }



     public function delete($id)
     {
         Post::where('id', $id)->delete();

         return back()->with('post_deleted', 'Post has been deleted successfully!');
     }
}



$ php artisan make:model Post -m

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const PerPage = 10;

    protected $table = 'posts';

    protected $fillable = ['title', 'body'];
}


# Eloquent CRUD
Route::get('/posts', [PostController::class, 'list'])->name('post.list');
Route::get('/post/add', [PostController::class, 'add'])->name('post.add');
Route::post('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::post('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
Route::get('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
```
