<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HomeContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_home',function(Blueprint $table){
            $table->id('id');
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('content')->nullable();
            $table->string('button_url')->nullable();
            $table->string('motamot_title')->nullable();
            $table->string('motamot_desc')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_thumbnail')->nullable();
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
