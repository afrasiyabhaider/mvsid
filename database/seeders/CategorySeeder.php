<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory as Faker;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $category = Category::create([
            'name'=> $faker->name,
        ]);

        for ($i=0; $i < 10; $i++) {
             Category::create([
                'name' => $faker->name,
                'parent_id'=>$category->id
            ]);
        }

    }
}
