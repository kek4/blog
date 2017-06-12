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
           $table->string('title', 100);
           $table->text('description');
           $table->integer('nbers')->default(0);
           $table->integer('bake_time')->default(0);
           $table->integer('prep_time')->default(0);
           $table->integer('temperature')->default(0);
         //   $table->integer('views')->default(0);
         //   $table->integer('likes')->default(0);
         //   $table->boolean('comments')->default(0);
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
