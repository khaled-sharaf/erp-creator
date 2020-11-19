<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFixedAssetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fixed_assets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->text('description', 65535)->nullable();
			$table->float('amount', 12);
			$table->integer('supplier_id')->unsigned();
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
		Schema::drop('fixed_assets');
	}

}
