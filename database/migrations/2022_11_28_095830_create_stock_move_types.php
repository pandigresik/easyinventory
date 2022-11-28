<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMoveTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_move_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 10)->unique();
            $table->string('name', 50);
            $table->tinyInteger('sign_value')->nullable()->default(1);
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();   
            $table->blameable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_move_types');
    }
}
