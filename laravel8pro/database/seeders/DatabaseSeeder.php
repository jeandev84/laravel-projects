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

        \App\Models\User::factory(10)->create();

        // $this->call([PostTableSeeder::class]);


        $faker = Faker::create();

        /*

        foreach (range(1, 1000) as $index) {
             DB::table('users')->insert([
                 'name' => $faker->name,
                 'email' => $faker->email,
                 'password' => bcrypt('secret'),
                 'phone' => $faker->phoneNumber
             ]);
        }

        foreach (range(1, 100) as $index)
        {
             DB::table('students')->insert([
                  'name'  => $faker->name,
                  'email' => $faker->email,
                  'phone' => $faker->phoneNumber,
             ]);
        }


        Employee::factory()->count(100)->create();


        foreach (range(1, 100) as $index) {

            DB::table('posts')->insert([
                'title' => $faker->text(40),
                'body'  => $faker->text(300)
            ]);

        }
        */

        foreach (range(1, 100) as $index)
        {
            // -6 month ago, + 1month later
            DB::table('users')->insert([
                'name'        => $faker->name,
                'email'       => $faker->unique()->safeEmail,
                'password'    => encrypt('password'),
                'created_at'  => $faker->dateTimeBetween('-6 month', '+1 month')
            ]);
        }

    }
}
