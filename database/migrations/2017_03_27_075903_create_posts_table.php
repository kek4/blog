<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('posts', function (Blueprint $table) {
           $table->increments('id');
           $table->string('title', 100)->unique();
           $table->text('description');
           $table->text('short_description');
           $table->integer('nbers')->default(0);
           $table->integer('bake_time')->default(0);
           $table->integer('prep_time')->default(0);
           $table->integer('temperature')->default(0);
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
        Schema::dropIfExists('posts');
    }
}
