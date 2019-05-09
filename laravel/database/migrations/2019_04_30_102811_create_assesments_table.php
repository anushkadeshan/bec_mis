<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssesmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assesments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->string('dsd');
            $table->string('dm_name');
            $table->string('title_of_action');
            $table->string('activity_code');
            $table->string('review_date');
            $table->unsignedInteger('employer_id')->nullable();
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
            $table->string('head_of_org')->nullable();
            $table->string('registered')->nullable();
            $table->string('type_of_reg')->nullable();
            $table->text('nature_of_business')->nullable();
            $table->string('no_of_employers')->nullable();
            $table->integer('worksites')->nullable();
            $table->integer('departments')->nullable();
            $table->string('time_from')->nullable();
            $table->string('time_to')->nullable();
            $table->string('days_from')->nullable();
            $table->string('days_to')->nullable();
            $table->string('women')->nullable();
            $table->string('full_time')->nullable();
            $table->string('part_time')->nullable();
            $table->string('shifts')->nullable();
            $table->string('contract')->nullable();
            $table->string('permanant')->nullable();
            $table->string('regularly')->nullable();
            $table->string('different_locations')->nullable();
            $table->string('disabled')->nullable();
            $table->string('hrd')->nullable();
            $table->string('app_letter')->nullable();
            $table->string('probation')->nullable();
            $table->string('duration')->nullable();
            $table->string('leave_policy')->nullable();
            $table->string('gender_policy')->nullable();
            $table->string('harassment')->nullable();
            $table->string('elaborate')->nullable();
            $table->string('equal_opportunity')->nullable();
            $table->string('prepared_language')->nullable();
            $table->string('starting_salary')->nullable();
            $table->string('facilities')->nullable();
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
        Schema::dropIfExists('assesments');
    }
}
