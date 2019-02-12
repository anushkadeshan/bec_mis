<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYouthsCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youths_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id')->nullable();
            $table->unsignedInteger('youth_id')->nullable();
            $table->string('status')->nullable();
            $table->string('completed_at')->nullable();
            $table->unique(['course_id', 'youth_id']);
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('youth_id')->references('id')->on('youths')->onDelete('cascade');
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
        Schema::dropIfExists('youths_courses');
    }
}
