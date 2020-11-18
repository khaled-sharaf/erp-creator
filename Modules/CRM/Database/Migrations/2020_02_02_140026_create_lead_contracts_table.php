<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('secret_id');
            $table->unsignedInteger('lead_id');
            $table->unsignedInteger('sales_id')->nullable();
            $table->date('start_date')->nullable();
            $table->integer('duration')->nullable();
            $table->string('job_title_lead')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('total_amount')->nullable();
            $table->longText('terms')->nullable();
            $table->text('note')->nullable();
            $table->unsignedInteger('created_by')->nullable();
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
        Schema::dropIfExists('lead_contracts');
    }
}
