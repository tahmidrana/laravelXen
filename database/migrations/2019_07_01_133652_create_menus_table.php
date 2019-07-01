<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->text('menu_url')->nullable();
            $table->string('menu_icon', 100)->nullable();
            $table->string('description', 150)->nullable();
            $table->tinyInteger('menu_order')->default(0);
            $table->unsignedInteger('parent_menu')->nullable();
            $table->foreign('parent_menu')->references('id')->on('menus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
