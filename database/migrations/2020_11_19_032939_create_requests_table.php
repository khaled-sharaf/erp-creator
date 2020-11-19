<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->boolean('type');
			$table->dateTime('from_date')->nullable();
			$table->dateTime('to_date')->nullable();
			$table->dateTime('check_date')->nullable();
			$table->text('description', 65535)->nullable();
			$table->enum('status', array('pending','approved','rejected'))->default('pending');
			$table->text('reason', 65535)->nullable();
			$table->integer('replier_id')->unsigned()->nullable();
			$table->char('year', 4)->nullable();
			$table->char('month', 2)->nullable();
			$table->char('day', 2)->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requests');
	}

}
