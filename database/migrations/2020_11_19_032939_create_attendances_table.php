<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttendancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendances', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->dateTime('check_in')->nullable();
			$table->dateTime('check_out')->nullable();
			$table->enum('type', array('request','fingerprint','manually'))->default('manually');
			$table->integer('request_id')->unsigned()->nullable();
			$table->integer('overtime')->nullable();
			$table->boolean('absent')->default(0);
			$table->enum('permission_type', array('am','pm'))->nullable();
			$table->integer('permission_time')->nullable();
			$table->text('comment', 65535)->nullable();
			$table->char('year', 4)->nullable();
			$table->char('month', 2)->nullable();
			$table->char('day', 2)->nullable();
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
		Schema::drop('attendances');
	}

}
