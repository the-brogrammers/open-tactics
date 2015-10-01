<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToPlayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('players', function ($table) {
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('players', function ($table) {
		    $table->dropColumn('user_id');
		});
    }
}
