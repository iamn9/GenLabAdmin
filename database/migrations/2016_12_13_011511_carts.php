<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Carts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('carts',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('borrower_id');
        
        $table->String('status');
        
        /**
         * Foreignkeys section
         */
        
        $table->foreign('borrower_id')->references('id_no')->on('users')->onDelete('cascade');
        
        // type your addition here

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('carts');
    }
}
