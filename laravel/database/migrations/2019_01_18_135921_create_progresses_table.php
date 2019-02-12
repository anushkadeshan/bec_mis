<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progresses', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('cg')->default(0);
            $table->boolean('vt')->default(0);
            $table->boolean('prof')->default(0);
            $table->boolean('soft_skills')->default(0);
            $table->boolean('jobs')->default(0);
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
        Schema::dropIfExists('progresses');
    }
}
