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
        */


        // \App\Models\User::factory(35)->create();

        // $this->call([PostTableSeeder::class]);

        foreach (range(1, 100) as $index)
        {
             DB::table('students')->insert([
                  'name'  => $faker->name,
                  'email' => $faker->email,
                  'phone' => $faker->phoneNumber,
             ]);
        }


        Employee::factory()->count(100)->create();
    }
}
