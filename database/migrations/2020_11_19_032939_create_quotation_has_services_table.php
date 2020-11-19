<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuotationHasServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quotation_has_services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('quotation_id')->unsigned();
			$table->integer('service_id')->unsigned();
			$table->integer('amount');
			$table->text('description')->nullable();
			$table->boolean('profit_method')->default(1);
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
		Schema::drop('quotation_has_services');
	}

}
