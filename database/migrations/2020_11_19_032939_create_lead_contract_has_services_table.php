<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeadContractHasServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lead_contract_has_services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('lead_contract_id')->unsigned();
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
		Schema::drop('lead_contract_has_services');
	}

}
