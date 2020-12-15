<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 10; $i++) {
            Manufacturer::create([
                'manufacturer_name'=>$faker->name,
                'shop_name'=>$faker->name,
                'address'=>"31st Lancashire County Surrey",
                'phone_number'=>$faker->e164PhoneNumber,
           ]);
       }
    }
}
