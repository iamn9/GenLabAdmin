<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Cart_items.
 *
 * @author  The scaffold-interface created at 2016-12-13 02:19:43am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class CartItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('cart_items',function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('cart_id');
            //$table->foreign('cart_id')->references->('id')->on('carts');
            $table->unsignedInteger('item_id');
            //$table->foreign('item_id')->references->('id')->on('items');
            $table->integer('qty')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('cart_items');
    }
}
