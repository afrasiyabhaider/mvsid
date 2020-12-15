<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefillInProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('refill')->nullable()->before('delete_at');
            $table->integer('no_of_box')->nullable()->before('delete_at');
            $table->double('margin')->nullable()->before('delete_at');
            $table->integer('stock')->nullable()->before('delete_at');
            $table->boolean('inventory')->nullable()->before('delete_at');
            $table->string('serial_number')->nullable()->before('delete_at');
            $table->boolean('x')->nullable()->before('deleted_at');
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
