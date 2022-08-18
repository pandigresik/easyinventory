<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {        
        Schema::create('menu_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('permission_id');
            $table->char('status', 1)->nullable()->default('1');
            $table->primary(['menu_id', 'permission_id']);
            $table->foreign('menu_id', 'fk_menu_permission_menus')->references('id')->on('menus');
            $table->foreign('permission_id', 'fk_menu_permission_permissions')->references('id')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('menu_permissions');
    }
}
