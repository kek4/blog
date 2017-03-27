<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('comments', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('article_id')->unsigned();
           $table->text('comment');
           $table->string('author_email');
           $table->string('author_name');
           $table->boolean('visible')->default(1);
           $table->timestamps();

           $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
