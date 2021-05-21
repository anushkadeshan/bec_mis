<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentoring', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->string('dsd');
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
            $table->integer('pwd_male');
            $table->integer('pwd_female');
            $table->integer('fathers');
            $table->integer('mothers');
            $table->integer('male_gurdians');
            $table->integer('female_gurdians');
            $table->unsignedInteger('resourse_person_id')->nullable();
            $table->foreign('resourse_person_id')->references('id')->on('resourse_people')->onDelete('cascade');
            $table->text('mode_of_conduct')->nullable();
            $table->text('topics')->nullable();
            $table->text('deliverables')->nullable();
            $table->string('attendance')->nullable();
            $table->text('photos')->nullable();
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
        Schema::dropIfExists('mentoring');
    }
}
