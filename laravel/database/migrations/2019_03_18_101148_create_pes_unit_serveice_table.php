<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesUnitServeiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pes_unit_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service')->nullable();
            $table->integer('male')->nullable();
            $table->integer('female')->nullable();
            $table->unsignedInteger('pes_id')->nullable();
            $table->foreign('pes_id')->references('id')->on('pes_units')->onDelete('cascade');
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
        Schema::dropIfExists('pes_unit_serveice');
    }
}
