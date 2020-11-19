<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuppliersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suppliers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('company_name', 191)->nullable();
			$table->string('phone', 191)->nullable();
			$table->string('whatsapp_phone', 191)->nullable();
			$table->string('address', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('logo', 191)->nullable();
			$table->string('latitude', 191)->nullable();
			$table->string('longitude', 191)->nullable();
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
		Schema::drop('suppliers');
	}

}
