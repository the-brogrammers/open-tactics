<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMapToGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('games', function ($table) {
			$table->integer('map_id')->unsigned();
			$table->foreign('map_id')->references('id')->on('maps');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('games', function ($table) {
		    $table->dropColumn('map_id');
		});
    }
}
