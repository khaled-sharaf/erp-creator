<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHostingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hostings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('hosting_name', 191);
			$table->integer('price');
			$table->text('description')->nullable();
			$table->date('booking_date');
			$table->date('renewal_date');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hostings');
	}

}