<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListIngIngTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listIng_ing', function (Blueprint $table) {
           $table->integer('ing_id')->unsigned()->index();
           $table->foreign('ing_id')->references('id')->on('ingredients')->onDelete('cascade');
           $table->integer('listIng_id')->unsigned()->index();
           $table->foreign('listIng_id')->references('id')->on('list_ingredients')->onDelete('cascade');
           $table->integer('quantity')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listIng_ing');
    }
}
