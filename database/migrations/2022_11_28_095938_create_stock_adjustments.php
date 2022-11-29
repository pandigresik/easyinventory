<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockAdjustments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number', 25)->unique();
            $table->date('transaction_date');
            $table->unsignedBigInteger('warehouse_id');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();

            $table->foreign('warehouse_id')->references('id')->on('warehouses')->delete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_adjustments');
    }
}
