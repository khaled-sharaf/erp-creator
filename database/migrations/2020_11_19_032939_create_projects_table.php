<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('lead_contract_id')->unsigned();
			$table->integer('designer_id')->unsigned()->nullable();
			$table->integer('designer_deadline')->unsigned()->nullable();
			$table->dateTime('designer_activated_at')->nullable();
			$table->dateTime('designer_accepted_at')->nullable();
			$table->integer('designer_progress')->unsigned()->default(0);
			$table->dateTime('designer_done_at')->nullable();
			$table->integer('marketer_id')->unsigned()->nullable();
			$table->integer('marketer_deadline')->unsigned()->nullable();
			$table->dateTime('marketer_activated_at')->nullable();
			$table->dateTime('marketer_accepted_at')->nullable();
			$table->integer('marketer_progress')->unsigned()->default(0);
			$table->dateTime('marketer_done_at')->nullable();
			$table->integer('advertiser_id')->unsigned()->nullable();
			$table->integer('advertiser_deadline')->unsigned()->nullable();
			$table->dateTime('advertiser_activated_at')->nullable();
			$table->dateTime('advertiser_accepted_at')->nullable();
			$table->integer('advertiser_progress')->unsigned()->default(0);
			$table->dateTime('advertiser_done_at')->nullable();
			$table->integer('project_progress')->unsigned()->default(0);
			$table->dateTime('project_done_at')->nullable();
			$table->text('addresses', 65535)->nullable();
			$table->text('phone_numbers', 65535)->nullable();
			$table->text('websites', 65535)->nullable();
			$table->text('emails', 65535)->nullable();
			$table->integer('designs_count')->unsigned()->nullable();
			$table->boolean('need_logo')->nullable();
			$table->string('logo_src', 191)->nullable();
			$table->boolean('need_cover')->nullable();
			$table->boolean('need_profile')->nullable();
			$table->text('colors_favorite', 16777215)->nullable();
			$table->text('design_info', 16777215)->nullable();
			$table->text('gallery')->nullable();
			$table->text('posts_type', 65535)->nullable();
			$table->integer('posts_count')->unsigned()->nullable();
			$table->text('client_products', 16777215)->nullable();
			$table->text('client_offers', 16777215)->nullable();
			$table->text('competitors_links', 16777215)->nullable();
			$table->integer('sponsored_posts_count')->unsigned()->nullable();
			$table->text('sponsored_posts_url', 16777215)->nullable();
			$table->text('targeted_places', 16777215)->nullable();
			$table->text('targeted_gender', 65535)->nullable();
			$table->text('targeted_age', 65535)->nullable();
			$table->integer('days_count')->unsigned()->nullable();
			$table->integer('day_budget')->unsigned()->nullable();
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
		Schema::drop('projects');
	}

}
