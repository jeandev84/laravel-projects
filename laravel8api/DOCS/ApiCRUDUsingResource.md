### API CRUD Using Resource

1. Create Model "Post" & Migration file & Factory
```php 

$ php artisan make:model Post -mf (create Model + Migration + Factory)
$ php artisan make:factory PostFactory 


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable = ['title', 'body'];
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

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(50),
            'body'  => $this->faker->text(300)
        ];
    }
}


<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Post::factory(20)->create();
    }
}

$ php artisan db:seed


```


3. Create a API Resource Controller "PostController"

```php 
$ php artisan make:controller Api/V1/PostController --api


<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $posts = Post::paginate(Post::PerPage);

        return PostResource::collection($posts);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     * @return PostResource
    */
    public function store(PostStoreRequest $request)
    {
         $post = Post::create($request->validated());

         return new PostResource($post);
    }



    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return PostResource
    */
    public function show(Post $post)
    {
         /* Post::findOrFail($id); */
         return new PostResource($post);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
         $post->update($request->validated());

         return new PostResource($post);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
         $post->delete();

         return response(null, Response::HTTP_NO_CONTENT);
    }
}


```


4. Create a Post Resource 

```php 
$ php artisan make:resource PostResource

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}


```


5. Add API Routes (./routes/api.php)

```php 

Route::group(['prefix' => 'v1'], function () {

    Route::apiResources([
        'posts' => PostController::class
    ]);
});


$ php artisan route:list 

+--------+-----------+---------------------+---------------+------------------------------------------------------------+------------------------------------------+
| Domain | Method    | URI                 | Name          | Action                                                     | Middleware                               |
+--------+-----------+---------------------+---------------+------------------------------------------------------------+------------------------------------------+
|        | GET|HEAD  | /                   |               | Closure                                                    | web                                      |
|        | GET|HEAD  | api/user            |               | Closure                                                    | api                                      |
|        |           |                     |               |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/v1/posts        | posts.index   | App\Http\Controllers\Api\V1\PostController@index           | api                                      |
|        | POST      | api/v1/posts        | posts.store   | App\Http\Controllers\Api\V1\PostController@store           | api                                      |
|        | GET|HEAD  | api/v1/posts/{post} | posts.show    | App\Http\Controllers\Api\V1\PostController@show            | api                                      |
|        | PUT|PATCH | api/v1/posts/{post} | posts.update  | App\Http\Controllers\Api\V1\PostController@update          | api                                      |
|        | DELETE    | api/v1/posts/{post} | posts.destroy | App\Http\Controllers\Api\V1\PostController@destroy         | api                                      |
|        | GET|HEAD  | sanctum/csrf-cookie |               | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                      |
+--------+-----------+---------------------+---------------+------------------------------------------------------------+------------------------------------------+

===========================================================================

Route::prefix('v1')->group(function () {

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/post', [PostController::class, 'store']);
    Route::get('/post/{post}', [PostController::class, 'show']);
    Route::put('/post/{post}', [PostController::class, 'update']);
    Route::delete('/post/{post}', [PostController::class, 'delete']);

});

$ php artisan route:list 


+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+
| Domain | Method   | URI                 | Name | Action                                                     | Middleware                               |
+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+
|        | GET|HEAD | /                   |      | Closure                                                    | web                                      |
|        | GET|HEAD | api/user            |      | Closure                                                    | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST     | api/v1/post         |      | App\Http\Controllers\Api\V1\PostController@store           | api                                      |
|        | GET|HEAD | api/v1/post/{id}    |      | App\Http\Controllers\Api\V1\PostController@show            | api                                      |
|        | PUT      | api/v1/post/{id}    |      | App\Http\Controllers\Api\V1\PostController@update          | api                                      |
|        | DELETE   | api/v1/post/{id}    |      | App\Http\Controllers\Api\V1\PostController@delete          | api                                      |
|        | GET|HEAD | api/v1/posts        |      | App\Http\Controllers\Api\V1\PostController@index           | api                                      |
|        | GET|HEAD | sanctum/csrf-cookie |      | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                      |
+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+

```

6. Implementation Methods Of API PostController

```php 

$ php artisan make:request PostStoreRequest

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body'  => 'required'
        ];
    }
}


$ php artisan make:request PostUpdateRequest

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body'  => 'required'
        ];
    }
}


```

7. Test API ( Example via Postman )

```php 
+--------+-----------+---------------------+---------------+------------------------------------------------------------+------------------------------------------+
| Domain | Method    | URI                 | Name          | Action                                                     | Middleware                               |
+--------+-----------+---------------------+---------------+------------------------------------------------------------+------------------------------------------+
|        | GET|HEAD  | /                   |               | Closure                                                    | web                                      |
|        | GET|HEAD  | api/user            |               | Closure                                                    | api                                      |
|        |           |                     |               |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD  | api/v1/posts        | posts.index   | App\Http\Controllers\Api\V1\PostController@index           | api                                      |
|        | POST      | api/v1/posts        | posts.store   | App\Http\Controllers\Api\V1\PostController@store           | api                                      |
|        | GET|HEAD  | api/v1/posts/{post} | posts.show    | App\Http\Controllers\Api\V1\PostController@show            | api                                      |
|        | PUT|PATCH | api/v1/posts/{post} | posts.update  | App\Http\Controllers\Api\V1\PostController@update          | api                                      |
|        | DELETE    | api/v1/posts/{post} | posts.destroy | App\Http\Controllers\Api\V1\PostController@destroy         | api                                      |
|        | GET|HEAD  | sanctum/csrf-cookie |               | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                      |
+--------+-----------+---------------------+---------------+------------------------------------------------------------+------------------------------------------+
--+---------------------+------+------------------------------------------------------------+------------------------------------------+

```
