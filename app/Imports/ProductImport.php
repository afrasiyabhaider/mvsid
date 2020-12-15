<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Store;
use App\Models\Vendor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Faker\Factory as Faker;

class ProductImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $products)
    {
        // dd($products);
        foreach ($products as $row) {

            $faker = Faker::create();
            if (isset($row['category_name']) && ($row['category_name'] != '' && $row['category_name'] != 'NULL')) {
                $cat = Category::where('name', $row['category_name'])->first();
                if (empty($cat)) {
                    $parent_id = Category::WhereNotNull('parent_id')->first()->parent_id;
                    $cat = Category::create([
                        'name' => $row['category_name'],
                        'parent_id' => $parent_id,
                    ]);
                    $row['category_id'] = $cat->id;
                }else{
                    $row['category_id'] = $cat->id;
                }
            }else{
                $row['category_id'] = NULL;
            }

            $category_id = NULL;

            if (isset($row['1st_category']) && ($row['1st_category'] != '' && $row['1st_category'] != 'NULL')) {
                $cat = Category::where('name', $row['1st_category'])->first();
                if (empty($cat)) {
                    $cat = Category::create([
                        'name' => $row['1st_category'],
                        'parent_id' => NULL,
                    ]);

                        $parent_id1 = $cat->id;
                        if (isset($row['2nd_category']) && ($row['2nd_category'] != '' && $row['2nd_category'] != 'NULL')) {
                            $cat2 = Category::where('name', $row['2nd_category'])->first();
                            if (empty($cat2)) {
                                $cat2 = Category::create([
                                    'name' => $row['2nd_category'],
                                    'parent_id' => $parent_id1,
                                ]);
                                    $category_id = $cat2->id;
                                    $parent_id2 = $cat2->id;
                                    if (isset($row['3rd_category']) && ($row['3rd_category'] != '' && $row['3rd_category'] != 'NULL')) {
                                        $cat3 = Category::where('name', $row['3rd_category'])->first();
                                        if (empty($cat3)) {
                                            $cat3 = Category::create([
                                                'name' => $row['3rd_category'],
                                                'parent_id' => $parent_id2,
                                            ]);

                                            $category_id = $cat3->id;
                                            // dd($cat3);
                                        }
                                    } else {
                                        $row['3rd_category'] = NULL;
                                    }
                            }else{
                                    $category_id = $cat2->id;
                                    $parent_id2 = $cat2->id;
                                    if (isset($row['3rd_category']) && ($row['3rd_category'] != '' && $row['3rd_category'] != 'NULL')) {
                                        $cat3 = Category::where('name', $row['3rd_category'])->first();
                                        if (empty($cat3)) {
                                            $cat3 = Category::create([
                                                'name' => $row['3rd_category'],
                                                'parent_id' => $parent_id2,
                                            ]);
                                        }
                                    } else {
                                        $row['3rd_category'] = NULL;
                                    }
                            }
                        } else {
                            $row['2nd_category'] = NULL;
                        }
                }else{
                        $parent_id1 = $cat->id;
                        if (isset($row['2nd_category']) && ($row['2nd_category'] != '' && $row['2nd_category'] != 'NULL')) {
                            $cat2 = Category::where('name', $row['2nd_category'])->first();
                            if (empty($cat2)) {
                                $cat2 = Category::create([
                                    'name' => $row['2nd_category'],
                                    'parent_id' => $parent_id1,
                                ]);
                                    $category_id = $cat2->id;
                                    $parent_id2 = $cat2->id;
                                    if (isset($row['3rd_category']) && ($row['3rd_category'] != '' && $row['3rd_category'] != 'NULL')) {
                                        $cat3 = Category::where('name', $row['3rd_category'])->first();
                                        if (empty($cat3)) {
                                            $cat3 = Category::create([
                                                'name' => $row['3rd_category'],
                                                'parent_id' => $parent_id2,
                                            ]);
                                            $category_id = $cat3->id;
                                        }
                                    } else {
                                        $row['3rd_category'] = NULL;
                                    }
                            }else{
                                    $category_id = $cat2->id;
                                    $parent_id2 = $cat2->id;
                                    if (isset($row['3rd_category']) && ($row['3rd_category'] != '' && $row['3rd_category'] != 'NULL')) {
                                        $cat3 = Category::where('name', $row['3rd_category'])->first();
                                        if (empty($cat3)) {
                                            $cat3 = Category::create([
                                                'name' => $row['3rd_category'],
                                                'parent_id' => $parent_id2,
                                            ]);
                                            $category_id = $cat3->id;
                                            // dd($cat3);
                                        }
                                    } else {
                                        $row['3rd_category'] = NULL;
                                    }
                            }
                        } else {
                            $row['2nd_category'] = NULL;
                        }


                }
            }else{
                $row['1st_category'] = NULL;
            }

            if(isset($row['vendor']) && ($row['vendor'] != '' || $row['vendor'] != 'NULL')){
                $vendor = Vendor::where('name', $row['vendor'])->first();
                if (empty($vendor)) {
                    // dd($row['vendor']);
                    $vendor = Vendor::create([
                        'name' => $row['vendor'],
                        'shop_name' => 'shop123',
                        'address' => 'not found',
                        'phone_number' => $faker->e164PhoneNumber,
                    ]);
                    $row['vendor'] = $vendor->id;
                }else{
                    $row['vendor'] = $vendor->id;
                }
            }else{
                $row['vendor'] = NULL;
            }

            /* if (isset($row['store_name']) && ($row['store_name'] != '' || $row['store_name'] != 'NULL')){
                $store = Store::where('store_name', $row['store_name'])->first();
                if (empty($store)) {
                    $store = Store::create([
                        'store_name' => $row['store_name'],
                        'address' => 'not found',
                        'contact' => $faker->e164PhoneNumber,
                    ]);
                    $row['store_id'] = $store->id;
                }else{
                    $row['store_id'] = $store->id;
                }
            }else{
                $row['store_id'] = NULL;
            } */


            if (isset($row['manufacturer']) && ($row['manufacturer'] != '' || $row['manufacturer'] != 'NULL')){
                $menuf = Manufacturer::where('manufacturer_name', $row['manufacturer'])->first();

                if (empty($menuf)) {
                    $menuf = Manufacturer::create([
                        'manufacturer_name' => $row['manufacturer'],
                        'shop_name' => 'shop123',
                        'address' => 'not found',
                        'phone_number' => $faker->e164PhoneNumber,
                    ]);
                    $row['menuf_id'] = $menuf->id;
                }else{
                    $row['menuf_id'] = $menuf->id;
                }
            }else{
                $row['menuf_id'] = NULL;
            }

            $product = Product::where('barcode', $row['barcode'])->first();
            if(empty($product)){
                $product = Product::create([
                    'barcode' => $row['barcode'],
                    'product_name' => $row['product_name'],
                    // 'pd_code' => $row['pd_code'],
                    'retail_price' => $row['rprice'],
                    'sell_price' => $row['price'],
                    'category1_name' => $row['1st_category'],
                    'category2_name' => $row['2nd_category'],
                    'category3_name' => $row['3rd_category'],
                    'size' => $row['size'],
                    'menuf_id'    => $row['menuf_id'],
                    'cost' => $row['cost'],
                    'margin' => $row['margin'],
                    'tax1' => $row['hst'],
                    'tax2' => $row['gst'],
                    'tax3' => $row['tax_included'],
                    'stock' => $row['stock'],
                    // 'minimum_stock' => $row['stock'],
                    'no_of_box'=> $row['nobox'],
                    'refill' => $row['refill'],
                    'inventory'=>$row['inventory'],
                    'vendor_id'   => $row['vendor'],
                    'deposit_amount' => $row['deposit'],
                    'buying_code' => $row['buying_code'],
                    'x' => $row['x'],
                    'serial_no' => $row['serial_no'],
                    'category_id' => $category_id,

                    // 'quantity' => $row['quantity'],
                    // 'pd_name2' => $row['pd_name2'],
                    // 'box_cost' => $row['box_cost'],
                    // 'item_cnt_per_box' => $row['item_cnt_per_box'],
                    // 'box_barcode' => $row['box_barcode'],
                    // 'food_stamp' => $row['food_stamp'],
                    // 'age_check' => $row['age_check'],
                    // 'scale_product' => $row['scale_product'],
                    // 'description' => $row['description'],
                    // 'liquore_price' => $row['liquore_price'],
                    // 'store_id'    => $row['store_id'],
                    // 'category_id' => $row['category_id'],
                ]);
            }else{
                    // $product->increment('quantity', $row['quantity']);
                    $product->update([
                        'barcode' => $row['barcode'],
                        'product_name' => $row['product_name'],
                        // 'pd_code' => $row['pd_code'],
                        'retail_price' => $row['rprice'],
                        'sell_price' => $row['price'],
                        'category1_name' => $row['1st_category'],
                        'category2_name' => $row['2nd_category'],
                        'category3_name' => $row['3rd_category'],
                        'size' => $row['size'],
                        'menuf_id'    => $row['menuf_id'],
                        'cost' => $row['cost'],
                        'margin' => $row['margin'],
                        'tax1' => $row['hst'],
                        'tax2' => $row['gst'],
                        'tax3' => $row['tax_included'],
                        'stock' => $row['stock'],
                        // 'minimum_stock' => $row['stock'],
                        'no_of_box' => $row['nobox'],
                        'refill' => $row['refill'],
                        'inventory' => $row['inventory'],
                        'vendor_id'   => $row['vendor'],
                        'deposit_amount' => $row['deposit'],
                        'buying_code' => $row['buying_code'],
                        'x' => $row['x'],
                        'serial_no' => $row['serial_no'],
                        'category_id' => $category_id,
/*                      'product_name' => $row['product_name'],
                        'pd_code' => $row['pd_code'],
                        'retail_price' => $row['rprice'],
                        'sell_price' => $row['sell_price'],
                        'barcode' => $row['barcode'],
                        'pd_name2' => $row['pd_name2'],
                        'cost' => $row['cost'],
                        'box_cost' => $row['box_cost'],
                        'item_cnt_per_box' => $row['item_cnt_per_box'],
                        'deposit_amount' => $row['deposit_amount'],
                        'size' => $row['size'],
                        'box_barcode' => $row['box_barcode'],
                        'food_stamp' => $row['food_stamp'],
                        'age_check' => $row['age_check'],
                        'scale_product' => $row['scale_product'],
                        'description' => $row['description'],
                        'liquore_price' => $row['liquore_price'],
                        'menuf_id'    => $row['menuf_id'],
                        'store_id'    => $row['store_id'],
                        'vendor_id'   => $row['vendor_id'],
                        'category_id' => $row['category_id'], */
                    ]);
            }

            /* $product = Product::updateOrCreate(
                [
                'barcode'   => $row['barcode'],
                ], [
                'product_name' => $row['product_name'],
                'pd_code' => $row['pd_code'],
                'retail_price' => $row['rprice'],
                'sell_price' => $row['sell_price'],
                'quantity' => $row['quantity'],
                'barcode' => $row['barcode'],
                'pd_name2' => $row['pd_name2'],
                'cost' => $row['cost'],
                'box_cost' => $row['box_cost'],
                'item_cnt_per_box' => $row['item_cnt_per_box'],
                'deposit_amount' => $row['deposit_amount'],
                'minimum_stock' => $row['minimum_stock'],
                'size' => $row['size'],
                'box_barcode' => $row['box_barcode'],
                'food_stamp' => $row['food_stamp'],
                'age_check' => $row['age_check'],
                'scale_product' => $row['scale_product'],
                'description' => $row['description'],
                'liquore_price' => $row['liquore_price'],
                'menuf_id'    => $row['menuf_id'],
                'store_id'    => $row['store_id'],
                'vendor_id'   => $row['vendor_id'],
                'category_id' => $row['category_id'],
            ]); */
        }
    }


    //defining heading row number
    public function headingRow(): int
    {
        return 1;
    }
}
