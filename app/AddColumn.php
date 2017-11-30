<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('items',function (Blueprint $table){

        $table->increments('id');
        $table->String('name');        
		$table->String('brand') ;
        $table->integer('quantity');
        $table->decimal('acquisitioncost',10,2);
        $table->decimal('wattage',10,2);
        $table->decimal('firsthour',10,2);
        $table->decimal('succeeding',10,2);

        /**
         * Foreignkeys section
         */



        $table->softDeletes();

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
        Schema::drop('items');
    }
}
