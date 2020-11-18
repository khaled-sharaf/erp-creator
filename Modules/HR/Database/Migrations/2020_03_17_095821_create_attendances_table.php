<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->enum('type', ['request', 'fingerprint', 'manually'])->default('manually');
            $table->unsignedInteger('request_id')->nullable();
            $table->integer('overtime')->nullable();
            $table->boolean('absent')->default(0);
            $table->enum('permission_type', ['am', 'pm'])->nullable();
            $table->integer('permission_time')->nullable();
            $table->text('comment')->nullable();
            $table->char('year', 4)->nullable();
            $table->char('month', 2)->nullable();
            $table->char('day', 2)->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
