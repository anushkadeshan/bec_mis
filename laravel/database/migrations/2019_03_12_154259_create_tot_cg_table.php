<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotCgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tot_cg', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_of_action');
            $table->string('activity_code');
            $table->string('meeting_date');
            $table->string('time_start');
            $table->string('time_end');
            $table->string('venue');
            $table->string('program_cost');
            $table->unsignedInteger('resourse_person_id')->nullable();
            $table->foreign('resourse_person_id')->references('id')->on('resourse_people')->onDelete('cascade');
            $table->text('mode_of_conduct')->nullable();
            $table->text('topics')->nullable();
            $table->text('deliverables')->nullable();
            $table->string('attendance')->nullable();
            $table->string('training_report')->nullable();
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
        Schema::dropIfExists('tot_cg');
    }
}
