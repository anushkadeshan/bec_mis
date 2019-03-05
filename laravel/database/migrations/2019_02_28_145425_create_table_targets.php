<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTargets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_targets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cg')->unsigned()->default(0)->nullable();
            $table->integer('soft')->unsigned()->default(0)->nullable();
            $table->integer('vt')->unsigned()->default(0)->nullable();
            $table->integer('prof')->unsigned()->default(0)->nullable();
            $table->integer('jobs')->unsigned()->default(0)->nullable();
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
        Schema::dropIfExists('table_targets');
    }
}
