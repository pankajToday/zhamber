<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_post');
            $table->string('language');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('id_post')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_langs');
    }
}
