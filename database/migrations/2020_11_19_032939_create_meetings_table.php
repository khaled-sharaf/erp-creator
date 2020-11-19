<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMeetingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meetings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('lead_id')->unsigned();
			$table->integer('meeting_id')->unsigned()->nullable();
			$table->dateTime('date')->nullable();
			$table->string('address', 191)->nullable();
			$table->integer('created_by')->unsigned()->nullable();
			$table->integer('meeting_detail_id')->unsigned()->nullable();
			$table->enum('status', array('done','next_meeting','project_delay','refused_offer','rejected'))->nullable();
			$table->text('note', 65535)->nullable();
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
		Schema::drop('meetings');
	}

}
