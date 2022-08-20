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
        Product::truncate();

        // Create (10) product items
        Product::factory()->count(10)->create();
    }
}
