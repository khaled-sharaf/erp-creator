<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlatformsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('platforms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('logo', 191);
			$table->string('cover_width', 20)->nullable();
			$table->string('cover_height', 20)->nullable();
			$table->string('profile_width', 20)->nullable();
			$table->string('profile_height', 20)->nullable();
			$table->string('post_width', 20)->nullable();
			$table->string('post_height', 20)->nullable();
			$table->boolean('display')->default(1);
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
		Schema::drop('platforms');
	}

}
