<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVendernameInProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('vendor_name')->nullable()->after('vendor_id');
            $table->string('manuf_name')->nullable()->after('menuf_id');
            $table->string('buying_code')->nullable()->after('pd_code');
            $table->string('tax1')->nullable()->after('buying_code');
            $table->string('tax2')->nullable()->after('buying_code');
            $table->string('tax3')->nullable()->after('buying_code');
            $table->string('category1_code')->nullable()->after('tax1');
            $table->string('category1_name')->nullable()->after('category1_code');
            $table->string('category2_code')->nullable()->after('category1_name');
            $table->string('category2_name')->nullable()->after('category2_code');
            $table->string('category3_code')->nullable()->after('category2_name');
            $table->string('category3_name')->nullable()->after('category3_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
