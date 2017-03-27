<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('articles', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name', 100);
           $table->text('description');
           $table->string('picture');
           $table->integer('views')->default(0);
           $table->integer('likes')->default(0);
           $table->boolean('comments')->default(1);
           $table->boolean('available')->default(0);
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
        Schema::dropIfExists('articles');
    }
}
