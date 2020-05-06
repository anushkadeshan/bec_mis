<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituteReviewCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_review_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('period_intake')->nullable();
            $table->integer('intake_per_batch')->nullable();
            $table->integer('current_following')->nullable();
            $table->integer('passed_out')->nullable();
            $table->unsignedInteger('institute_reviews_id')->nullable();
            $table->foreign('institute_reviews_id')->references('id')->on('institute_reviews')->onDelete('cascade');
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
        Schema::dropIfExists('institute_review_courses');
    }
}
