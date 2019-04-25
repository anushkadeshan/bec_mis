<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituteReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->string('dsd')->nullable();
            $table->string('dm_name')->nullable();
            $table->string('title_of_action');
            $table->string('activity_code');
            $table->string('review_date')->nullable();
            $table->unsignedInteger('institute_id')->nullable();
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
            $table->string('head_of_institute')->nullable();
            $table->integer('contact')->nullable();
            $table->string('commencement_date')->nullable();
            $table->string('tvec_ex_date')->nullable();
            $table->string('ojt_compulsory')->nullable();
            $table->string('courses_not_compulsory')->nullable();
            $table->string('followup')->nullable();
            $table->string('services_offered')->nullable();
            $table->string('trainee_allowance')->nullable();
            $table->integer('amount')->nullable();
            $table->string('source')->nullable();
            $table->string('soft_skill')->nullable();
            $table->string('agreement_soft_skill')->nullable();
            $table->string('gaps')->nullable();
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
        Schema::dropIfExists('institute_reviews');
    }
}
