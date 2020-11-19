<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeadContractsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lead_contracts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('secret_id', 191);
			$table->integer('lead_id')->unsigned();
			$table->integer('sales_id')->unsigned()->nullable();
			$table->date('start_date')->nullable();
			$table->integer('duration')->nullable();
			$table->string('duration_unit')->nullable();
			$table->string('job_title_lead', 191)->nullable();
			$table->integer('tax')->nullable();
			$table->integer('total_amount')->nullable();
			$table->integer('currency_id')->nullable();
			$table->text('terms')->nullable();
			$table->text('note', 65535)->nullable();
			$table->integer('created_by')->unsigned()->nullable();
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
		Schema::drop('lead_contracts');
	}

}
