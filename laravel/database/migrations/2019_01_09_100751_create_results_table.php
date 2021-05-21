<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ol_year')->nullable();
            $table->integer('ol_attempt')->nullable();
            $table->string('ol_pass_or_fail')->nullable();
            $table->integer('al_year')->nullable();
            $table->integer('al_attempt')->nullable();
            $table->string('al_pass_or_fail')->nullable();
            $table->string('stream')->nullable();
            $table->string('degree')->nullable();
            $table->string('pass_out_year')->nullable();
            $table->string('medium')->nullable();
            $table->string('grade')->nullable();
            $table->string('university')->nullable();
            $table->text('other_professional_qualifications')->nullable();
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
        Schema::dropIfExists('results');
    }
}
