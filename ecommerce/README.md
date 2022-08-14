# Ecommerce project

--------------------------------------------------------------
- Laravel Framework 6.20.44 ( https://laravel.com/docs/6.x )
--------------------------------------------------------------

1. Create database ```lp_ecommerce```
2. Configuration ```.env``` file
```php
...

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=lp_ecommerce
DB_USERNAME=postgres
DB_PASSWORD=123456

...

"./config/database.php"

 'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '5fsd98g6sfd6gs9df7g_',
            'prefix_indexes' => true,
            'strict' => false,
            'schema' => 'public',
            'sslmode' => 'prefer',
],


```

3. Lunch server
```php
$ php artisan serve
```

4. Make Controller
```php 
$ php artisan make:controller HomeController
```

5. Make table via migration
- create=products (название таблицы, которое мы хотим создавать в БД)
```php 
$ php artisan make:migration create_products_table --create=products

... Name of Migration: xxxxx_create_products_table

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('price');
            $table->boolean('in_stock');
            $table->text('description');
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
        Schema::dropIfExists('products');
    }
}

... 
```

6. Migrate
```php 
$ php artisan migrate
```

7. Add new column to existant table
```php 
$ php artisan make:migration add_new_price_to_products_table --create=products

...

<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewPriceToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        if(! Schema::hasTable('products')) {

            Schema::create('products', function (Blueprint $table) {
                ....
            });
        }
        */

        Schema::table('products', function (Blueprint $table) {
            $table->integer('new_price')->nullable(); // необязательное поле
            // $table->addColumn('integer', 'new_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}



$ php artisan migrate
...

Duplicate table in postgres
$ php artisan tinker

>>> Schema::drop('products')
=> null
>>> exit



$ php artisan migrate:rollback
$ php artisan migrate


```

8. Seeding (Add data to the table)
```php 
./database/seeds/ProductsTableSeeder.php

$ php artisan make:seeder ProductsTableSeeder


<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/**
 *
*/
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
        for ($i = 1; $i < 11; $i++) {

            DB::table('products')->insert([
                'title' => 'Product '. $i,
                'price' => rand(200, 1500),
                'in_stock' => 1,
                'description' => 'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.'
            ]);
        }
    }
}


Запуск :

$ php artisan db:seed ( запуск все Seeders )
$ php artisan db:seed --class=ProductsTableSeeder ( запуск конкретный Seeder ) 

```


9. Make Model
```php 

$ php artisan make:model Models/Product (app/Models/Product)

$ php artisan make:model Product
$ php artisan make:model Product --migration or -m


<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 *
*/
class Product extends Model
{
      /* protected $table = 'products'; */

      
}


```

10. RelationShip (Связь)
```php 

Один продукт имеет набор множественных картинок

OneToMany (One Product HasMany ProductImage)
       
        - ProductImage
Product - ProductImage
        - ProductImage
        ......

Создание Модель ProductImage и файл миграции.

$ php artisan make:model ProductImage -m


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('img');

            $table->bigInteger('product_id')->unsigned(); // число без знака

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade')
            ;

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
        Schema::dropIfExists('product_images');
    }
}

....

Запускаем миграцию
$ php artisan migrate

================================================================

Создание категории ( Category )

$ php artisan make:model Category -m


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('desc');
            $table->string('img');
            $table->string('alias'); // or slug
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
        Schema::dropIfExists('categories');
    }
}


$ php artisan migrate

```


11. Define Global variable for application 

```php 

<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;



/**
 *
*/
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);

        // определяем глобальную переменную, которую используем на каждом контроллере

        $categories = Category::orderBy('id')->get();

        View::share([
            'categories' => $categories
        ]);
    }
}


Добавление нового поля category_id для продукта products

$ php artisan make:migration add_category_id_to_products_table --table=products


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->bigInteger('category_id')->unsigned(); // число без знака

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}


$ php artisan migrate


```


12. Installation Laravel Cart
 - https://github.com/darryldecode/laravelshoppingcart
```php 

$ composer require "darryldecode/cart:~2.0"
$ composer require "darryldecode/cart" (for Laravel 6)

1. Open config/app.php and add this line to your Service Providers Array.
Darryldecode\Cart\CartServiceProvider::class

2. Open config/app.php and add this line to your Aliases
'Cart' => Darryldecode\Cart\Facades\CartFacade::class
 
3. Optional configuration file (useful if you plan to have full control)
php artisan vendor:publish --provider="Darryldecode\Cart\CartServiceProvider" --tag="config"

Copied File [/vendor/darryldecode/cart/src/Darryldecode/Cart/config/config.php] To [/config/shopping_cart.php]
Publishing complete.

```
