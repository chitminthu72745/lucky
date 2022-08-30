<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->string('sku')->nullable();
            $table->string('stock_status');
            $table->string('manage_stock')->nullable();
            $table->string('stock_quantity')->nullable();
            $table->string('backorders')->nullable();
            $table->string('low_stock')->nullable();
            $table->string('solid_individually')->nullable();
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
        Schema::dropIfExists('inventories');
    }
}
