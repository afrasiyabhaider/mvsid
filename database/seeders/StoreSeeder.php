<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Store::create([
                'store_name' => $faker->name,
                'address' => "31st bakers street new London",
                'contact' => $faker->e164PhoneNumber,
            ]);
        }
    }
}
