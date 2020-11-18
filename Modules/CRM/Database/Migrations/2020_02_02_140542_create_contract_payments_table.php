<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lead_contract_id');
            $table->integer('amount');
            $table->date('date');
            $table->boolean('profit_method')->default(1);
            $table->boolean('payment_method')->default(1);
            $table->text('description')->nullable();
            $table->timestamps();

            // $table->foreign('lead_contract_id')
            //     ->references('id')
            //     ->on('lead_contracts')
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
        Schema::dropIfExists('contract_payments');
    }
}
