<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncoperationSoftSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoperation_soft_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->string('dsd')->nullable();
            $table->string('dm_name')->nullable();
            $table->string('title_of_action');
            $table->string('activity_code');
            $table->string('review_date')->nullable();
            $table->unsignedInteger('institute_id')->nullable();
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
            $table->string('tvec_ex_date')->nullable();
            $table->text('nature_of_assistance')->nullable();
            $table->string('gsrn')->nullable();
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
        Schema::dropIfExists('incoperation_soft_skills');
    }
}
