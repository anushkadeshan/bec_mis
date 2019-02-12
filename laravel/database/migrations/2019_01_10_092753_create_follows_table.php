<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->nullable();
            $table->integer('institute_id')->nullable();
            $table->string('status')->nullable();
            $table->string('completed_at')->nullable();
            $table->unsignedInteger('youth_id');
            $table->foreign('youth_id')->references('id')->on('youths');
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
        Schema::dropIfExists('follows');
    }
}
