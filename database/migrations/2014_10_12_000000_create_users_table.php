<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_ar')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('rule')->default(0); // 0 = user, 1 = suber admin, 2 = admin
            $table->boolean('active')->default(1); // 1 = access login, 0 = not access login

            $table->string('phone')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('work_email')->nullable();
            $table->string('work_address')->nullable();

            $table->string('photo')->nullable();
            $table->string('id_cart')->unique()->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();

            $table->enum('marital_status', ['single', 'engaged', 'married', 'others'])->nullable()->default('single');
            $table->enum('gender', ['male', 'female', 'others'])->nullable()->default('male');

            $table->date('birth_date')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('visa_number')->nullable();
            $table->date('visa_expire_date')->nullable();
            $table->text('document_note')->nullable();
            $table->string('certificate_level')->nullable();
            $table->string('school')->nullable();

            $table->unsignedInteger('job_title_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('work_period_id')->nullable();
            $table->date('hiring_date')->nullable();
            $table->integer('salary')->nullable();

            $table->longText('documents')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
