### MultipleConnectionToDB 


```php 

./.env

...

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database1
DB_USERNAME=root
DB_PASSWORD=


DB_CONNECTION2=mysql
DB_HOST2=127.0.0.1
DB_PORT2=5432
DB_DATABASE2=database2
DB_USERNAME2=root
DB_PASSWORD2=


<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        ....

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'mysql2' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST2', '127.0.0.1'),
            'port' => env('DB_PORT2', '3306'),
            'database' => env('DB_DATABASE2', 'forge'),
            'username' => env('DB_USERNAME2', 'forge'),
            'password' => env('DB_PASSWORD2', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

       ...

];


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
        // mysql2 from ./config/database.php
        Schema::connection('mysql2')->create('posts', function (Blueprint $table) {
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


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $connection = "mysql2";
    
    protected $table = "posts";
}


$ php artisan migrate

$ php artisan make:controller Connection/MultipleConnectionController


<?php

namespace App\Http\Controllers\Connection;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Student;
use Illuminate\Http\Request;

class MultipleConnectionController extends Controller
{
      public function addStudents()
      {
          $students = [
              ['name' => 'Smith', "email" => 'smith@gmail.com', 'phone' => '1234567890'],
              ['name' => 'Jennifer', "email" => 'jennifer@gmail.com', 'phone' => '1234567891'],
          ];

          Student::insert($students);

          return "Students are added";
      }



      public function addPosts()
      {
          $posts = [
              ['title' => 'first post title', 'body' => 'first post description'],
              ['title' => 'second post title', 'body' => 'second post description'],
          ];


          Post::insert($posts);

          return "Posts are created";
      }


      public function getStudents()
      {
          return Student::all();
      }


      public function getPosts()
      {
          return Post::all();
      }
}


# Multi connection to databases

Route::get('/add-students', [\App\Http\Controllers\Connection\MultipleConnectionController::class, 'addStudents']);
Route::get('/add-posts', [\App\Http\Controllers\Connection\MultipleConnectionController::class, 'addPosts']);
Route::get('/students', [\App\Http\Controllers\Connection\MultipleConnectionController::class, 'getStudents']);
Route::get('/posts', [\App\Http\Controllers\Connection\MultipleConnectionController::class, 'getPosts']);



```
