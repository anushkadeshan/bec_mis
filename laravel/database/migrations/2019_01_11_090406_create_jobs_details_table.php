<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('employer_name');
            $table->unsignedInteger('youth_id');
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
        Schema::dropIfExists('jobs_details');
    }
}
