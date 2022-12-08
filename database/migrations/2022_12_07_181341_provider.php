<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Provider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_type')->defaultValue('dentist');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->string('about')->nullable();
            $table->string('url')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->rememberToken();
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
        //
    }
}