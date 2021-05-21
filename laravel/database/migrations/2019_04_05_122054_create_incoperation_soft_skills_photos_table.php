<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncoperationSoftSkillsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoperation_soft_skills_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('images')->nullable();
            $table->unsignedInteger('iss_id')->nullable();
            $table->foreign('iss_id')->references('id')->on('incoperation_soft_skills')->onDelete('cascade');
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
        Schema::dropIfExists('incoperation_soft_skills_photos');
    }
}
