<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUomUomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uoms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');            
            $table->double('factor');
            $table->double('rounding')->nullable();            
            $table->enum('uom_type',['reference','bigger','smaller'])->default('reference');   
            $table->unsignedBigInteger('uom_category_id');
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();
            
            $table->foreign('uom_category_id')->references('id')->on('uom_categories')->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uoms');
    }
}
