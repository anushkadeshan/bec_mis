<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYouthsVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youths_vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('youth_id')->nullable();
            $table->foreign('youth_id')->references('id')->on('youths')->onDelete('cascade');
            $table->unsignedInteger('vacancy_id')->nullable();
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('cascade');
            $table->string('applied_on')->nullable();
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
        Schema::dropIfExists('youths_vacancies');
    }
}
