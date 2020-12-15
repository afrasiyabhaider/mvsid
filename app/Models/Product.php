<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Milon\Barcode\DNS1D;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
                            'category_id',
                            'vendor_id',
                            'vendor_name',
                            'menuf_id',
                            'manuf_name',
                            'store_id',
                            'product_name',
                            'pd_name2',
                            'image',
                            'cost',
                            'box_cost',
                            'item_cnt_per_box',
                            'sell_price',
                            'retail_price',
                            'deposit_amount',
                            'quantity',
                            'minimum_stock',
                            'size',
                            'pd_code',
                            'buying_code',
                            'tax3',
                            'tax2',
                            'tax1',
                            'category1_code',
                            'category1_name',
                            'category2_code',
                            'category2_name',
                            'category3_code',
                            'category3_name',
                            'barcode',
                            'box_barcode',
                            'food_stamp',
                            'age_check',
                            'scale_product',
                            'description',
                            'liquore_price',
                            'refill',
                            'no_of_box',
                            'margin',
                            'stock',
                            'inventory',
                            'serial_number'	,
                            'x',
                        ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function vendor(){
        return $this->belongsTo('App\Models\Vendor','vendor_id');
    }

    public function menufecturer(){
        return $this->belongsTo('App\Models\Manufacturer', 'menuf_id');
    }

    public function store(){
        return $this->belongsTo('App\Models\Stores','store_id');
    }
}
