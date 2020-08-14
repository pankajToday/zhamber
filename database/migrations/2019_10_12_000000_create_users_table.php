<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('username')->unique();
            
            $table->string('email')->unique();
            $table->string('mobile');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('cover_photo')->nullable();
            $table->string('my_language')->default('all');
            $table->string('gender')->default('Male');

            $table->string('name')->nullable();
            $table->string('city')->nullable();
            $table->text('aboutme')->nullable();
            $table->unsignedBigInteger('id_country')->nullable();

             $table->string('provider')->nullable();
             $table->string('provider_id')->unique()->nullable(); 
             $table->string('access_token')->nullable();  
           
            $table->string('session_id')->nullable();
            $table->text('fkey')->nullable()->comment('FCM Key for Push notification');
            $table->string('id_device')->nullable()->comment('Mobile Device Id');

            $table->rememberToken();
            $table->timestamps();
             $table->foreign('id_country')->references('id')->on('countries');
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
