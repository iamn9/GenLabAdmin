<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Listing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('owner_id');
        
        /**
         * Foreignkeys section
         */
        
        $table->foreign('owner_id')->references('id_no')->on('users')->onDelete('cascade');
        
        // type your addition here

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('listing');
    }
}
