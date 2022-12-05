<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VolunteersContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_volunteers',function(Blueprint $table){
            $table->id('id');
            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->string('photo')->nullable();
            $table->string('address')->nullable();
            $table->string('fb_url')->nullable();
            $table->string('phone')->nullable();
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
