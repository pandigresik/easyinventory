<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('stock_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('storage_location_id');
            $table->unsignedInteger('quantity')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();
            
            $table->foreign('storage_location_id')->references('id')->on('storage_locations')->delete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->delete('cascade');

            $table->unique(['storage_location_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_products');
    }
}
