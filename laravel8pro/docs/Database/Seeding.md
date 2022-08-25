### Seeding

```php 

$ php artisan make:seeder PostTableSeeder

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('posts')->insert([
             'title' => 'Title from seeder',
             'body'  => 'Description from seeder'
         ]);
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

        $this->call(PostTableSeeder::class);
        
    }
}


<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker::create();

         foreach (range(1, 100) as $index) {

             DB::table('posts')->insert([
                 'title' => $faker->sentence(5),
                 'body'  => $faker->paragraph(4)
             ]);

         }
    }
}


$ php artisan db:seed
$ php artisan db:fresh --seed

```
