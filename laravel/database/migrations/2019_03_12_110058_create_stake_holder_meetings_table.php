<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStakeHolderMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stake_holder_meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->string('dsd');
            $table->string('gnd');
            $table->string('dm_name');
            $table->string('title_of_action');
            $table->string('activity_code');
            $table->string('meeting_date');
            $table->string('time_start');
            $table->string('time_end');
            $table->string('venue');
            $table->string('program_cost');
            $table->integer('total_male');
            $table->integer('total_female');
            $table->text('decisions')->nullable();
            $table->string('attendance')->nullable();
            $table->integer('branch_id');
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
        Schema::dropIfExists('stake_holder_meetings');
    }
}
