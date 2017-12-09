<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOnAccountabilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {        
		
		 Schema::table('accountabilities', function (Blueprint $table) {
          $table->integer('item_id');
		  $table->datetime('date_returned')->nullable();
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
              $table->dropColumn('item_id');
			  $table->dropColumn('date_returned');
        });
    }
}
