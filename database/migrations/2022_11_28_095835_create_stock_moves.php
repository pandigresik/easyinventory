<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMoves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_moves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('transaction_date');
            $table->string('number', 25)->unique();
            $table->string('references',50)->nullable()->comment('fill PO number, SO number or else');
            $table->string('responsbility', 50)->nullable()->comment('external actor');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('stock_move_type_id');
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->delete('cascade');
            $table->foreign('stock_move_type_id')->references('id')->on('stock_move_types')->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_moves');
    }
}
