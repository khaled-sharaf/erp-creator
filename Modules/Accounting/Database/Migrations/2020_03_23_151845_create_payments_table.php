<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount', 12, 2)->default(0);
            $table->enum('operation_type', ['credit', 'debit', 'credit_return', 'debit_return'])->nullable();
            $table->unsignedInteger('account_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('contract_id')->nullable();
            $table->unsignedInteger('payment_contract_id')->nullable();
            $table->enum('debit_type', ['expense', 'supplier'])->nullable();
            $table->unsignedInteger('supplier_id')->nullable();
            $table->unsignedInteger('expense_id')->nullable();
            $table->longText('documents')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
