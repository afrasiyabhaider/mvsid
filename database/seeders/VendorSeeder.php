<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class VendorSeeder extends Seeder
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
            Vendor::create([
                'name'=>$faker->name,
                'shop_name'=>$faker->name,
                'address'=>"31st bakers street new London",
                'phone_number'=>$faker->e164PhoneNumber,
           ]);
       }

    }
}
