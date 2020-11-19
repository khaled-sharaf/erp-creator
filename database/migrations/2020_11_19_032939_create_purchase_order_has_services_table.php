<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchaseOrderHasServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_order_has_services', function(Blueprint $table)
		{
			$table->integer('purchase_order_id')->unsigned();
			$table->integer('service_id')->unsigned();
			$table->integer('quantity')->unsigned()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('purchase_order_has_services');
	}

}
