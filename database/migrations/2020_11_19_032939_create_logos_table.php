<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('lead_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('logo_name', 191);
			$table->text('photo')->nullable();
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
		Schema::drop('logos');
	}

}
