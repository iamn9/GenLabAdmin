<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Carts.
 *
 * @author  The scaffold-interface created at 2016-12-13 01:15:11am
 * @link  https://github.com/amranidev/scaffold-interface
 */
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
