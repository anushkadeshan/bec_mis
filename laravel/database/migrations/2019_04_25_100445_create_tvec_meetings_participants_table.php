<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTvecMeetingsParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tvec_meetings_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('position')->nullable();
            $table->string('institute')->nullable();
            $table->string('institute_type')->nullable();
            $table->unsignedInteger('tvec_id')->nullable();
            $table->foreign('tvec_id')->references('id')->on('tvec_meetings')->onDelete('cascade');
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
        Schema::dropIfExists('tvec_meetings_participants');
    }
}
