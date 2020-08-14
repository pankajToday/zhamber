<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            
            $table->bigIncrements('id');
            $table->string('iunique')->nullable();
            $table->string('title')->nullable();
            $table->string('iseo')->nullable();
            $table->boolean('is_active')->default(false);
            $table->string('image');
            
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->string('language')->nullable();

            $table->boolean('is_rejected')->default(false);
            $table->string('rejected_reason')->nullable();
            $table->string('rejected_by')->nullable();
            
            
            $table->integer('n_like')->default(0);
            $table->integer('n_dlike')->default(0);
            $table->integer('n_share')->default(0);
            $table->integer('n_views')->default(0);
            
            $table->enum('created_by_type', ['U', 'A'])->default('U');
            $table->string('created_by')->nullable();
            
            $table->unsignedBigInteger('id_user');

            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users');

        
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
