<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProjectHasPlatformsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project_has_platforms', function(Blueprint $table)
		{
			$table->foreign('platform_id')->references('id')->on('platforms')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('project_id')->references('id')->on('projects')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('project_has_platforms', function(Blueprint $table)
		{
			$table->dropForeign('project_has_platforms_platform_id_foreign');
			$table->dropForeign('project_has_platforms_project_id_foreign');
		});
	}

}
