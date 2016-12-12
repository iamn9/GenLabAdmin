<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Listings.
 *
 * @author  The scaffold-interface created at 2016-12-12 06:48:47am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Listings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('listings',function (Blueprint $table){
            $table->increments('id');
            $table->String('name');
            $table->longText('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('listings');
    }
}
