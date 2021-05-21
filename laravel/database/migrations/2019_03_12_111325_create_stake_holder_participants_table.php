<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStakeHolderParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stake_holder_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('designation')->nullable();
            $table->string('institute')->nullable();
            $table->unsignedInteger('stake_holder_meeting_id')->nullable();
            $table->foreign('stake_holder_meeting_id')->references('id')->on('stake_holder_meetings')->onDelete('cascade');
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
        Schema::dropIfExists('stake_holder_participants');
    }
}
