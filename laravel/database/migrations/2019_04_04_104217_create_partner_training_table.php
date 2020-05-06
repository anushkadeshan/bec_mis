<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->string('dsd')->nullable();
            $table->string('dm_name')->nullable();
            $table->string('title_of_action');
            $table->string('activity_code');
            $table->string('program_date')->nullable();
            $table->unsignedInteger('institute_id')->nullable();
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
            $table->string('institutional_review')->nullable();          
            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('mou_signed')->nullable();
            $table->string('date_mou_signed')->nullable();
            $table->double('bec_contribution')->nullable();
            $table->double('partner_contribution')->nullable();
            $table->double('student_contribution')->nullable();
            $table->double('total_cost')->nullable();
            $table->integer('total_male')->nullable();
            $table->integer('total_female')->nullable();
            $table->integer('pwd_male')->nullable();
            $table->integer('pwd_female')->nullable();
            $table->string('review_report')->nullable();
            $table->string('mou_report')->nullable();
            $table->string('group_photo')->nullable();
            $table->integer('branch_id')->nullable();
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
        Schema::dropIfExists('partner_training');
    }
}
