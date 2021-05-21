<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_supports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->string('dsd');
            $table->string('dm_name');
            $table->string('title_of_action');
            $table->string('activity_code');
            $table->string('program_date');
            $table->unsignedInteger('institute_id')->nullable();
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
            $table->string('institutional_review');          
            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('total_male')->nullable();
            $table->integer('total_female')->nullable();
            $table->integer('pwd_male')->nullable();
            $table->integer('pwd_female')->nullable();
            $table->string('review_report')->nullable();
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
        Schema::dropIfExists('course_supports');
    }
}
