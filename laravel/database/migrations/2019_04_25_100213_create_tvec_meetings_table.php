<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTvecMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tvec_meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->string('dsd')->nullable();
            $table->string('dm_name')->nullable();
            $table->string('title_of_action');
            $table->string('activity_code');
            $table->string('program_date')->nullable();
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('venue')->nullable();
            $table->integer('total_male');
            $table->integer('total_female');
            $table->integer('total_institutes');
            $table->text('matters_discussed')->nullable();
            $table->text('decisions_agreed')->nullable();
            $table->text('matters_to_follow')->nullable();
            $table->string('attendance')->nullable();
            $table->string('meeting_minute')->nullable();
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
        Schema::dropIfExists('tvec_meetings');
    }
}
