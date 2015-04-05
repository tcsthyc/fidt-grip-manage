<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToHealthTipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('health_tips', function($table)
		{
		    $table->string('title');
		    $table->string('content');

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
		//
		Schema::table('health_tips', function($table)
		{
		    $table->dropColumn('title');
		    $table->dropColumn('content');
			$table->dropColumn('user_id');
		});
	}

}
