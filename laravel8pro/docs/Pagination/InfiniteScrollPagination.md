### Infinite Scroll Pagination

```php 

$ php artisan make:model Post -m


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
}



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
            $table->string('title');
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

namespace Database\Seeders;

use App\Models\Employee;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
    */
    public function run()
    {
        // \App\Models\User::factory(35)->create();

        $faker = Faker::create();

        foreach (range(1, 100) as $index) {

            DB::table('posts')->insert([
                'title' => $faker->text(40),
                'body'  => $faker->text(300)
            ]);

        }

    }
}


$ php artisan db:seed

$ php artisan make:controller Pagination/PostController

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

./resources/views/pagination/posts/index.blade.php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Infinite Scroll Pagination</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>
<body>

  <section style="padding-top:60px;">
       <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <h2 class="text-center">
                       Infinite Scroll Pagination
                   </h2>
               </div>
               <div class="col-md-12" id="post-data">
                    @include('pagination.ajax.posts.list')
               </div>
           </div>
       </div>
  </section>

  <!-- Loading -->
  <div class="ajax-load text-center" style="display: none;">
     <p><img src="{{ asset('assets/img/loader.gif') }}" alt="loader" style="width: 150px;"> Loading More Posts</p>
  </div>

  <script>
     function loadMoreData(page)
     {
          // console.log('OK');

          $.ajax({
             url: '?page='+ page,
             type: 'GET',
             beforeSend: function () {
                 $(".ajax-load").show();
             }
          })
          .done(function (data) {
               if(data.html === " ") {
                   $('.ajax-load').html('No more records found.');
                   return;
               }

               $('.ajax-load').hide();
               $("#post-data").append(data.html);
          })
          .fail(function (jqXHR, ajaxOptions, thrownError) {
                alert("Server not responding...")
          });
     }

     let page = 1;

     $(window).scroll(function () {

         if($(window).scrollTop() + $(window).height() >= $(document).height()) {
             page++;
             loadMoreData(page)
             /*
             setTimeout(function () {
                 loadMoreData(page)
             }, 500)
             */
         }
     })

  </script>
</body>
</html>


./resources/views/pagination/ajax/posts/list.blade.php

@foreach($posts as $post)
    <div class="card" style="margin-bottom: 20px;">
         <div class="card-header">
              <h3><a href="#">{{ $post->title }}</a></h3>
         </div>
        <div class="card-body">
            <p>{{ $post->body }}</p>
            <div class="text-center">
                <button type="button" class="btn btn-success">Read more</button>
            </div>
        </div>
    </div>
@endforeach



# Route Infinite Scroll Pagination
Route::get('/posts', [\App\Http\Controllers\Pagination\PostController::class, 'index'])
   ->name('posts.list');
   
```
