<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('name_ar', 191)->nullable();
			$table->string('email', 191)->nullable()->unique();
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password', 191);
			$table->boolean('rule')->default(0);
			$table->boolean('active')->default(1);
			$table->string('phone', 191)->nullable();
			$table->string('home_phone', 191)->nullable();
			$table->string('emergency_phone', 191)->nullable();
			$table->string('work_phone', 191)->nullable();
			$table->string('work_email', 191)->nullable();
			$table->string('work_address', 191)->nullable();
			$table->string('photo', 191)->nullable();
			$table->string('id_cart', 191)->nullable()->unique();
			$table->string('country', 191)->nullable();
			$table->string('city', 191)->nullable();
			$table->string('address', 191)->nullable();
			$table->string('nationality', 191)->nullable();
			$table->enum('marital_status', array('single','engaged','married','others'))->nullable()->default('single');
			$table->enum('gender', array('male','female','others'))->nullable()->default('male');
			$table->date('birth_date')->nullable();
			$table->string('bank_account_number', 191)->nullable();
			$table->string('visa_number', 191)->nullable();
			$table->date('visa_expire_date')->nullable();
			$table->text('document_note', 65535)->nullable();
			$table->string('certificate_level', 191)->nullable();
			$table->string('school', 191)->nullable();
			$table->integer('job_title_id')->unsigned()->nullable();
			$table->integer('department_id')->unsigned()->nullable();
			$table->integer('work_period_id')->unsigned()->nullable();
			$table->date('hiring_date')->nullable();
			$table->integer('salary')->nullable();
			$table->text('documents')->nullable();
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
