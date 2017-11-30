<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
              $table->String('brand') ->default('None');
              $table->integer('quantity') ->default(0);
              $table->decimal('acquisitioncost',10,2) ->default(0);
              $table->decimal('wattage',10,2) ->default(0);
              $table->decimal('firsthour',10,2) ->default(0);
              $table->decimal('succeeding',10,2) ->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
          $table->dropColumn('brand');
          $table->dropColumn('quantity');
          $table->dropColumn('acquisition');
          $table->dropColumn('wattage');
          $table->dropColumn('firsthour');
          $table->dropColumn('succeeding');
        });
    }
}
