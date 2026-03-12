<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i <= 30; $i++) {

            $newClient = new Client();

            $newClient->name = $faker->firstName();
            $newClient->surname = $faker->lastName();
            $newClient->email = $faker->safeEmail();
            $newClient->phone = $faker->phoneNumber();
            $newClient->address = $faker->address();

            $newClient->save();
        }
    }
}
