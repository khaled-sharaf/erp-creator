<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignedToMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('assigned_to_meeting', function (Blueprint $table) {
        //     $table->unsignedInteger('user_id');
        //     $table->unsignedInteger('meeting_id');
        //     $table->foreign('meeting_id')
        //         ->references('id')
        //         ->on('meetings')
        //         ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('assigned_to_meeting');
    }
}
