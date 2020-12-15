<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('menuf_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            /*
            $table->string('category_name')->nullable()->after('category_id');
            $table->string('vendor_name')->nullable()->after('vendor_id');
            $table->string('manuf_name')->nullable()->after('menuf_id');
            $table->string('store_name')->nullable()->after('store_id');
            */

            $table->string('product_name');
            $table->string('pd_name2')->nullable();
            $table->string('image')->nullable();
            $table->double('cost')->nullable();
            $table->double('box_cost')->nullable();
            $table->double('item_cnt_per_box')->nullable();
            $table->double('sell_price');
            $table->double('retail_price');
            $table->double('deposit_amount')->nullable();
            $table->integer('quantity');
            $table->integer('minimum_stock')->nullable();
            $table->double('size')->nullable();
            $table->string('pd_code')->nullable();
            $table->string('barcode');
            $table->string('box_barcode')->nullable();
            $table->boolean('food_stamp')->default(0)->nullable();
            $table->boolean('age_check')->default(0)->nullable();
            $table->boolean('scale_product')->default(0)->nullable();
            $table->string('description')->nullable();
            $table->double('liquore_price')->nullable();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('menuf_id')->references('id')->on('manufacturers');
            $table->foreign('store_id')->references('id')->on('stores');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
