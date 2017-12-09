<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnDueDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {        
		
		 Schema::table('accountabilities', function (Blueprint $table) {
          $table->dropColumn('due_date');		  
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
			  $table->integer('due_date');
        });
    }
}
