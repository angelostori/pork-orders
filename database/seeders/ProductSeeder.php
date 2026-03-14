<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {

            $newProduct = new Product();

            $newProduct->name = $faker->word();
            $newProduct->description = $faker->sentence();
            $newProduct->price = $faker->randomFloat(2, 1, 100);

            $newProduct->save();
        }
    }
}
