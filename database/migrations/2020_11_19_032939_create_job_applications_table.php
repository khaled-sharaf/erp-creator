<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobApplicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_applications', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->integer('department_id')->nullable();
			$table->string('cv')->nullable();
			$table->string('linked_in')->nullable();
			$table->text('comment')->nullable();
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
		Schema::drop('job_applications');
	}

}
