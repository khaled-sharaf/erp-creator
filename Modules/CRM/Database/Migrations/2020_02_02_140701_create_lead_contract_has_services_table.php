<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadContractHasServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_contract_has_services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lead_contract_id');
            $table->unsignedInteger('service_id');
            $table->integer('amount');
            $table->boolean('profit_method')->default(1);
            $table->timestamps();

            // $table->foreign('lead_contract_id')
            //     ->references('id')
            //     ->on('lead_contracts')
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
        Schema::dropIfExists('lead_contract_has_services');
    }
}
