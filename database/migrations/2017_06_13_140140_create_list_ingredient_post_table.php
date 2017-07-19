<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListIngredientPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_ingredient_post', function (Blueprint $table) {
           $table->integer('post_id')->unsigned()->index();
           $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
           $table->integer('list_ingredient_id')->unsigned()->index();
           $table->foreign('list_ingredient_id')->references('id')->on('list_ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_ingredient_post');
    }
}
