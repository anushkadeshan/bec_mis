<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesUnitSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pes_unit_supports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->string('dsd');
            $table->string('dm_name');
            $table->string('title_of_action');
            $table->string('activity_code');
            $table->string('visit_date');
            $table->string('support_date');
            $table->text('gaps');
            $table->string('gsrns')->nullable();
            $table->unsignedInteger('pes_identification_id');
            $table->foreign('pes_identification_id')->references('id')->on('pes_units')->onDelete('cascade');
            $table->string('photos');
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
        Schema::dropIfExists('pes_unit_supports');
    }
}
