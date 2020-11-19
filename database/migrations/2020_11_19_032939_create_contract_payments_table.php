<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contract_payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('lead_contract_id')->unsigned();
			$table->integer('amount');
			$table->date('date');
			$table->boolean('profit_method')->default(1);
			$table->boolean('payment_method')->default(1);
			$table->text('description', 65535)->nullable();
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
		Schema::drop('contract_payments');
	}

}
