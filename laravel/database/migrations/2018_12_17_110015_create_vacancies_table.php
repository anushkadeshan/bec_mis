<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('job_type');
            $table->string('industry');
            $table->string('business_function');
            $table->string('location');
            $table->string('district');
            $table->float('salary')->nullable();
            $table->integer('total_vacancies')->nullable();
            $table->date('dedline');
            $table->string('min_qualification');
            $table->string('specializaion');
            $table->string('skills')->nullable();
            $table->string('gender');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('employer_id');
            $table->foreign('employer_id')->references('id')->on('employers');
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
        Schema::dropIfExists('vacancies');
    }
}