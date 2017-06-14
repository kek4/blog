<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pictures', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('post_id')->unsigned();
           $table->text('alt');
           $table->text('title');
           $table->timestamps();

           $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
