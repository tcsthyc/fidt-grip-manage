<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasureRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('measure_records', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('customer_id')->unsigned();
			$table->integer('daily_status_id')->unsigned();			
			$table->timestamp('record_local_time');

			$table->float('total_mvc');
			$table->float('total_endurance');
			$table->float('total_explosive');

			$table->float('index_mvc');
			$table->float('index_endurance');
			$table->float('index_explosive');

			$table->float('middle_mvc');
			$table->float('middle_endurance');
			$table->float('middle_explosive');

			$table->float('ring_mvc');
			$table->float('ring_endurance');
			$table->float('ring_explosive');

			$table->float('little_mvc');
			$table->float('little_endurance');
			$table->float('little_explosive');

			$table->foreign('customer_id')->references('id')->on('customers');
			$table->foreign('daily_status_id')->references('id')->on('daily_statuses');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('measure_records');
	}

}
