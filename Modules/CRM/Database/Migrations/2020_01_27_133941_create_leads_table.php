<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('whatsapp_phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('id_cart')->unique()->nullable();

            $table->string('company_name')->nullable();
            $table->string('company_phone')->unique()->nullable();
            $table->string('company_email')->unique()->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_scope')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->unsignedInteger('assign_to')->nullable();
            $table->unsignedInteger('lead_status_id')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->text('note')->nullable();
            $table->boolean('type')->default(0);
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
        Schema::dropIfExists('leads');
    }
}
