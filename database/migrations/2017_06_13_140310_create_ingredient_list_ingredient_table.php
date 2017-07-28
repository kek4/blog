<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientListIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_list_ingredient', function (Blueprint $table) {
           $table->integer('ingredient_id')->unsigned()->index();
           $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
           $table->integer('list_ingredient_id')->unsigned()->index();
           $table->foreign('list_ingredient_id')->references('id')->on('list_ingredients')->onDelete('cascade');
           $table->string('quantity')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_list_ingredient');
    }
}
