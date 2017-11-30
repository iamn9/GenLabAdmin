<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountabilities', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('borrower_id')->unique();
            $table->string('borrower_name')->default('None');
            $table->datetime('date_borrowed')->nullable();
            $table->datetime('due_date')->nullable();
            $table->decimal('elapsed_time', 10,2)->nullable();
            $table->decimal('total_fee', 10,2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::drop('accountabilities');
    }
}
