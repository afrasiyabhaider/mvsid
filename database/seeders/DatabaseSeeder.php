<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Vendor;
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
        \App\Models\User::factory(10)->create();
        $this->call(AdminSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(VendorSeeder::class);
        // $this->call(ManufacturerSeeder::class);
        // $this->call(StoreSeeder::class);
        // $this->call(ProductSeeder::class);
    }
}
