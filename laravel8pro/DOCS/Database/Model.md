### Model 

```php 

$ php artisan make:model Post

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

}


<?php
namespace App\Http\Controllers;

use App\Models\Post;
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


      public function getAllPostsUsingModel()
      {
         return Post::all();
      }
}


Route::get('/all-posts', [PostController::class, 'getAllPostsUsingModel'])->name('posts.all');


```
