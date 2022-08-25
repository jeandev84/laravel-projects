### Join Clauses

```php 
$ php artisan make:migration add_phone_to_users_table --table=users

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
}



$ php artisan make:migration add_user_id_to_posts_table --table=posts

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            
            $table->bigInteger('user_id')->nullable();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // or SET NULL
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
             $table->dropForeign('user_id');
             $table->dropColumn('user_id');
        });
    }
}



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



      public function innerJoinClause()
      {

          /*
            $result = DB::table('users')
               ->join('posts', 'user_id', '=', 'posts.user_id')
               ->select('users.name as userName', 'posts.title as postTitle', 'posts.body as postBody')
               ->get();
          */

           return DB::table('users')
                        ->join('posts', 'user_id', '=', 'posts.user_id')
                        ->select('users.name', 'posts.title', 'posts.body')
                        ->get();

      }



      public function leftJoinClause()
      {
          return DB::table('users')
                 ->leftJoin('posts', 'user_id', '=', 'posts.user_id')
                 ->get();
      }



    public function rightJoinClause()
    {
        return DB::table('users')
            ->rightJoin('posts', 'user_id', '=', 'posts.user_id')
            ->get();
    }
}


Route::get('/posts/inner-join', [PostController::class, 'innerJoinClause'])->name('post.inner.join');
Route::get('/posts/left-join', [PostController::class, 'leftJoinClause'])->name('post.left.join');
Route::get('/posts/right-join', [PostController::class, 'rightJoinClause'])->name('post.right.join');

```
