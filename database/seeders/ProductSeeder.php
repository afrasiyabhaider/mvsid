<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $store_id = Store::pluck('id');
        $vendor_id = Vendor::pluck('id');
        $menuf_id = Manufacturer::pluck('id');

        $cat_id = Category::whereNotNull('parent_id')->pluck('id');

        $user = User::create([
            'name'=>'employee',
            'email' => $faker->email,
            'password' => Hash::make('password'),
            ]);

        for ($i=0; $i < 100; $i++) {
            $product = Product::create([
                'product_name' => $faker->unique()->name,
                'retail_price' => 30.9,
                'sell_price' => 30.3,
                'image' => 'https://via.placeholder.com/30x30',
                'quantity' => 10,
                'barcode' => $faker->unique()->ean13,
                'pd_name2'=> $faker->unique()->name,
                'cost'=> 300,
                'box_cost'=> 313,
                'item_cnt_per_box'=> 3,
                'deposit_amount'=> 100.3,
                'minimum_stock'=> 23,
                'size'=> 32.3,
                'pd_code'=> $faker->unique()->name,
                'box_barcode'=> $faker->unique()->ean13,
                'description'=> $faker->paragraph,
                'liquore_price'=> 3.23,
                'vendor_id'=> $faker->randomElement($vendor_id),
                'menuf_id'=> $faker->randomElement($menuf_id),
                'store_id'=> $faker->randomElement($store_id),
                'category_id'=> $faker->randomElement($cat_id),
            ]);
        }
    }
}
