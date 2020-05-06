<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacementsYouthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placements_youths', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('youth_id')->nullable();
            $table->foreign('youth_id')->references('id')->on('youths')->onDelete('cascade');
            $table->string('type_of_support')->nullable();
            $table->unsignedInteger('employer_id')->nullable();
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
            $table->unsignedInteger('vacancy_id')->nullable();
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');
            $table->unsignedInteger('placements_id')->nullable();
            $table->foreign('placements_id')->references('id')->on('placements')->onDelete('cascade');
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
        Schema::dropIfExists('placements_youths');
    }
}
