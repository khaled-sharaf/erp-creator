<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lead_id');
            $table->unsignedInteger('meeting_id')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('meeting_detail_id')->nullable();
            $table->enum('status', ['done', 'next_meeting', 'project_delay', 'refused_offer', 'rejected'])->nullable();
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('lead_id')
            //     ->references('id')
            //     ->on('leads')
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
        Schema::dropIfExists('meetings');
    }
}
