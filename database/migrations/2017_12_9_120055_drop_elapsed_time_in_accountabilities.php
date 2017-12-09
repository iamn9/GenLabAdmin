<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropElapsedTimeInAccountabilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {        

		 Schema::table('accountabilities', function (Blueprint $table) {
          $table->dropColumn('elapsed_time');          
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
       Schema::table('accountabilities', function (Blueprint $table) {
              $table->String('elapsed_time');
        });
    }
}
