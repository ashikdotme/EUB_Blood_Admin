<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AboutContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_about',function(Blueprint $table){
            $table->id('id');
            $table->string('title')->nullable();
            $table->longText('content')->nullable(); 
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
