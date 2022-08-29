### Database 

Configuration (.env)
```php

... 

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel_full_course
DB_USERNAME=postgres
DB_PASSWORD=123456

... 

```

Make Controller 
```php 
$ php artisan make:controller PostController

$ php artisan make:migration create_posts_table


'id INT(16) PRIMARY KEY AUTO_INCREMENT',
'title VARCHAR(200)',
'body TEXT'
              
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->text('body');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

$ php artisan migrate


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
}


./posts/list.blade.php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

      <div class="container mt-3">
          <h1>Posts</h1>
          <div class="post-list">
              <div class="row">
                  @foreach($posts as $post)
                      <div class="col-4">
                          <div class="card mb-3">
                              <div class="card-header">
                                  <h3>{{ $post->title }}</h3>
                              </div>
                              <div class="card-body">
                                  <p>{{ $post->body }}</p>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </div>

</body>
</html>


./routes/web.php

Route::get('/posts', [PostController::class, 'list'])->name('posts.list');

```
