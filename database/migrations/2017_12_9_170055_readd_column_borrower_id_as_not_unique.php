<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReaddColumnBorrowerIdAsNotUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {        
		
		 Schema::table('accountabilities', function (Blueprint $table) {
          $table->dropColumn('borrower_id');
		  $table->integer('borrower_id', 11);
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
              $table->dropColumn('borrower_id');
			  $table->integer('borrower_id')->unique();
        });
    }
}
