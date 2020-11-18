<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('kind', ['bank', 'cash', 'partner']);
            $table->enum('type', ['saving', 'current', 'joint', 'recom'])->nullable();
            $table->string('account_no', 50)->unique()->nullable();
            $table->double('ratio', 4, 2)->nullable();
            $table->char('id_card', 14)->unique()->nullable();
            $table->double('balance', 12, 2)->default(0);
            $table->double('credit', 12, 2)->default(0);
            $table->double('debit', 12, 2)->default(0);
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
        Schema::dropIfExists('accounts');
    }
}
