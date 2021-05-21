<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchCareerGuidanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches_careerGuidances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->unsignedInteger('cg_id')->nullable();
            $table->foreign('cg_id')->references('id')->on('career_guidances')->onDelete('cascade');            
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
        Schema::dropIfExists('branch_careerGuidance');
    }
}
