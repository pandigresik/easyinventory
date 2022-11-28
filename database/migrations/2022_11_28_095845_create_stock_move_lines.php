<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMoveLines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_move_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stock_move_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('storage_location_id');
            $table->unsignedInteger('quantity');
            $table->string('lot_number', 20)->nullable();
            $table->string('description', 80)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();

            $table->foreign('storage_location_id')->references('id')->on('storage_locations')->delete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->delete('cascade');
            $table->foreign('stock_move_id')->references('id')->on('stock_moves')->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_move_lines');
    }
}
