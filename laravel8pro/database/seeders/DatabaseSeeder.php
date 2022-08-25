<?php

namespace Database\Seeders;

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

        foreach (range(1, 1000) as $index) {
             DB::table('users')->insert([
                 'name' => $faker->name,
                 'email' => $faker->email,
                 'password' => bcrypt('secret'),
                 'phone' => $faker->phoneNumber
             ]);
        }


        // \App\Models\User::factory(35)->create();

        // $this->call([PostTableSeeder::class]);
    }
}
