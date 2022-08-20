# SPA ( Single Page Application) via Laravel 8
- https://laravel.com/docs/8.x

1. Installation laravel
```
$ composer create-project laravel/laravel:^8.0 microservice
```

2. Lunch Server
```
$ php artisan serve
```


3. Configuration Database
```
...

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=spa_microservice
DB_USERNAME=postgres
DB_PASSWORD=123456

...
```


4.Create Models
```php
$ php artisan make:model Product -m

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
            $table->id();
            $table->string('name');
            $table->decimal('price');
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


$ php artisan migrate
```


5. Make Controller 
```
$ php artisan make:controller Api/V1/ProductController --api
```


6. Make Factory
```php 
$ php artisan make:factory Product

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->text(10),
            'price' => rand(100, 200)
        ];
    }
}


$ php artisan tinker
App\Models\Product::factory()->create();
App\Models\Product::factory()->count(10)->create();

Psy Shell v0.11.8 (PHP 8.0.20 — cli) by Justin Hileman
>>> App\Models\Product::factory()->create();
=> App\Models\Product {#4493
     name: "Quas.",
     price: 130,
     updated_at: "2022-08-20 06:14:42",
     created_at: "2022-08-20 06:14:42",
     id: 11,
   }


....



```

7. Make Seeder 
```php 
$ php artisan make:seeder ProductSeeder


<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;



class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
        // create (10) product items
        Product::factory()->count(10)->create();
    }
}


<?php

namespace Database\Seeders;

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
        $this->call(ProductSeeder::class);
    }
}


$ php artisan db:seed

```
