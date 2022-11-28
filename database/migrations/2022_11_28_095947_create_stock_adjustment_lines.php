<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockAdjustmentLines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_adjustment_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('storage_location_id');
            $table->unsignedInteger('count_quantity');
            $table->unsignedInteger('onhand_quantity');
            $table->date('transaction_date');            
            $table->text('description')->nullable();
            $table->enum('state', ['draft','onprogress','release'])->default('draft');
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();
            
            $table->foreign('storage_location_id')->references('id')->on('storage_locations')->delete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_adjustment_lines');
    }
}
