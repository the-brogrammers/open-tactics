<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('users', function ($table) {
		    $table->char('api_token', 32);
		    $table->dateTime('last_login');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('users', function ($table) {
		    $table->dropColumn('api_token');
		    $table->dropColumn('last_login');
		});
    }
}
