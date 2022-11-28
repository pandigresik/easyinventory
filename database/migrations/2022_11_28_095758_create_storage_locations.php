<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 10)->unique();
            $table->string('name', 50);
            $table->text('description');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedInteger('_lft');
            $table->unsignedInteger('_rgt');
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
        Schema::dropIfExists('storage_locations');
    }
}
