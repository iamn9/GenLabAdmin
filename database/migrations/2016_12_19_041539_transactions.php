<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Transactions.
 *
 * @author  The scaffold-interface created at 2016-12-19 04:15:40am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('transactions',function (Blueprint $table){

        $table->increments('id');
        $table->unsignedInteger('cart_id');
        $table->datetime('submitted_at')->nullable();
        $table->datetime('prepared_at')->nullable();
        $table->datetime('released_at')->nullable();
        $table->datetime('completed_at')->nullable();
        
        /**
         * Foreignkeys section
         */
        $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
        
        
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
        Schema::drop('transactions');
    }
}
