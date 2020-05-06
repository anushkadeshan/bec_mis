<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesUnitsGapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pes_units_gaps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gap_num');
            $table->string('meterials_provided')->nullable();
            $table->integer('units')->nullable();
            $table->string('usage')->nullable();
            $table->string('date_provided')->nullable();
            $table->double('cost')->nullable();
            $table->unsignedInteger('pes_units_support_id');
            $table->foreign('pes_units_support_id')->references('id')->on('pes_unit_supports')->onDelete('cascade');
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
        Schema::dropIfExists('pes_units_gaps');
    }
}
