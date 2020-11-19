<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrintingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('printings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('lead_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('printing_name', 191);
			$table->string('photo', 191);
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
		Schema::drop('printings');
	}

}
