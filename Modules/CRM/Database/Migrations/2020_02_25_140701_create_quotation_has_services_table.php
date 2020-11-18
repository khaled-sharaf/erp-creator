<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationHasServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_has_services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quotation_id');
            $table->unsignedInteger('service_id');
            $table->integer('amount');
            $table->boolean('profit_method')->default(1);
            $table->timestamps();

            // $table->foreign('quotation_id')
            //     ->references('id')
            //     ->on('quotations')
            //     ->onDelete('cascade');

            // $table->foreign('service_id')
            //     ->references('id')
            //     ->on('services')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotation_has_services');
    }
}
