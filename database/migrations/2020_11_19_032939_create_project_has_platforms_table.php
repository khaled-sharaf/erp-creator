<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectHasPlatformsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_has_platforms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned()->index('project_has_platforms_project_id_foreign');
			$table->integer('platform_id')->unsigned()->index('project_has_platforms_platform_id_foreign');
			$table->string('url', 191)->nullable();
			$table->text('auth', 65535)->nullable();
			$table->boolean('need_platform')->default(0);
			$table->string('need_name', 191)->nullable();
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
		Schema::drop('project_has_platforms');
	}

}
