<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSupportsYouthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_supports_youth', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('youth_id')->nullable();
            $table->foreign('youth_id')->references('id')->on('youths')->onDelete('cascade');
            $table->string('nature_of_support')->nullable();
            $table->string('institute_type')->nullable();
            $table->unsignedInteger('course_support_id')->nullable();
            $table->foreign('course_support_id')->references('id')->on('course_supports')->onDelete('cascade');
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
        Schema::dropIfExists('course_supports_youth');
    }
}
