<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUomCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('uom_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');                       
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
        Schema::dropIfExists('uom_categories');
    }
}
