<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->enum('kind', array('bank','cash','partner'));
			$table->enum('type', array('saving','current','joint','recom'))->nullable();
			$table->string('account_no', 50)->nullable()->unique();
			$table->float('ratio', 4)->nullable();
			$table->char('id_card', 14)->nullable()->unique();
			$table->float('balance', 12)->default(0.00);
			$table->float('credit', 12)->default(0.00);
			$table->float('debit', 12)->default(0.00);
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
		Schema::drop('accounts');
	}

}
