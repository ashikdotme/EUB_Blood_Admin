<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VolunteersPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_volenteers_page',function(Blueprint $table){
            $table->id('id');
            $table->string('title')->nullable(); 
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
