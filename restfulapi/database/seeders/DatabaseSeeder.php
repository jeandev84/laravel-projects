<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Desk;
use App\Models\DeskList;
use App\Models\Task;
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

        Desk::factory(5)->create();
        DeskList::factory(20)->create();
        Card::factory(80)->create();
        Task::factory(200)->create();
    }
}
