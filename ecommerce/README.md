# Ecommerce project

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

