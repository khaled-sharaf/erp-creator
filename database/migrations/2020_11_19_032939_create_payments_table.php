<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('amount', 12)->default(0.00);
			$table->enum('operation_type', array('credit','debit'))->nullable();
			$table->integer('account_id')->unsigned()->nullable();
			$table->integer('client_id')->unsigned()->nullable();
			$table->enum('debit_type', array('expense','supplier'))->nullable();
			$table->integer('supplier_id')->unsigned()->nullable();
			$table->integer('expense_id')->unsigned()->nullable();
			$table->text('documents')->nullable();
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
		Schema::drop('payments');
	}

}
