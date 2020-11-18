<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('secret_id');
            $table->unsignedInteger('lead_id');
            $table->unsignedInteger('sales_id');
            $table->integer('total_amount')->nullable();
            $table->timestamps();

            // $table->foreign('lead_id')
            //     ->references('id')
            //     ->on('leads')
            //     ->onDelete('cascade');

            // $table->foreign('sales_id')
            //     ->references('id')
            //     ->on('users')
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
        Schema::dropIfExists('quotations');
    }
}
