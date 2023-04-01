<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWarehouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('user_warehouse', function (Blueprint $table) {            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('warehouse_id');            
            $table->primary(['user_id', 'warehouse_id']);
            $table->foreign('user_id', 'fk_user_warehouse_user')->references('id')->on('menus');
            $table->foreign('warehouse_id', 'fk_user_warehouse_warehouse')->references('id')->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_warehouse');
    }
}
