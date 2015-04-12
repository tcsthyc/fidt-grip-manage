<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('name')->unique();
			$table->string('password',60);
			$table->tinyInteger('age');
			$table->float('height');
			$table->float('weight');
			$table->enum('sex',array('male','female'));
			$table->float('bfp');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customers');
	}

}
