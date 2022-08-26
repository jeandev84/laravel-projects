### One To Many

- Example: One Post Has Many Comments
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

    const PerPage = 10;

    protected $table = 'posts';

    protected $fillable = ['title', 'body'];


    
    /**
     * @return HasMany
    */
    public function comments()
    {
         return $this->hasMany(Comment::class);
    }
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


$ php artisan make:model Comment -m

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->bigInteger('post_id')->unsigned();
            $table->timestamps();
            $table->foreign('post_id')
                  ->references('id')
                  ->on('posts')->onDelete('cascade');
        });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
    */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;


    protected $table = "comments";


    
    /**
     * @return BelongsTo
    */
    public function post()
    {
         return $this->belongsTo(Post::class);
    }
}


$ php artisan migrate
$ php artisan make:controller Eloquent/PostController


<?php

namespace App\Http\Controllers\Eloquent\RelationShip\OneToMany;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
       public function addPost()
       {
           $post = new Post();
           $post->title = "First Post Title";
           $post->body  = "First Post Description";
           $post->save();
           return "Post has been created successfully!";
       }



       public function addComment($postId)
       {
            $post = Post::find($postId);

            $comment = new Comment();
            $comment->comment = "This is the first comment";
            $post->comments()->save($comment);

            return "Comment has been posted.";
       }
       
       
       
       public function getCommentsByPostId($postId)
       {
            $comments = Post::find($postId)->comments;

            return $comments;
       }
}


# Eloquent RelationShip (OneToMany)
Route::get('/add-post', [\App\Http\Controllers\Eloquent\RelationShip\OneToMany\PostController::class, 'addPost'])
    ->name('post.add');

Route::get('/add-comment/{postId}', [\App\Http\Controllers\Eloquent\RelationShip\OneToMany\PostController::class, 'addComment'])
    ->name('post.add.comment');
    
```
