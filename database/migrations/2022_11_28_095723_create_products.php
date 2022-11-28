<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 10)->unique();
            $table->string('name', 50);
            $table->text('description');
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('uom_id');
            $table->timestamps();
            $table->softDeletes();
            $table->blameable();
            
            $table->foreign('uom_id')->references('id')->on('uoms')->delete('cascade');
            $table->foreign('product_category_id')->references('id')->on('product_categories')->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
