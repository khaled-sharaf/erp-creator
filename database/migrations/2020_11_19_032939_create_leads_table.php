<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leads', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('phone', 191)->unique();
			$table->string('whatsapp_phone', 191)->nullable()->unique();
			$table->string('email', 191)->nullable()->unique();
			$table->string('id_cart', 191)->nullable()->unique();
			$table->string('company_name', 191)->nullable();
			$table->string('company_phone', 191)->nullable()->unique();
			$table->string('company_email', 191)->nullable()->unique();
			$table->string('company_logo', 191)->nullable();
			$table->string('company_address', 191)->nullable();
			$table->string('company_scope', 191)->nullable();
			$table->string('latitude', 191)->nullable();
			$table->string('longitude', 191)->nullable();
			$table->integer('assign_to')->unsigned()->nullable();
			$table->integer('lead_status_id')->unsigned()->nullable();
			$table->integer('created_by')->unsigned()->nullable();
			$table->text('note', 65535)->nullable();
			$table->boolean('type')->default(0);
			$table->softDeletes();
			$table->timestamps();
			$table->string('password')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('leads');
	}

}
