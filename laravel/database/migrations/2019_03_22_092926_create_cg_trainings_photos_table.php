<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCgTrainingsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cg_trainings_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('images')->nullable();
            $table->unsignedInteger('cg_trainings_id')->nullable();
            $table->foreign('cg_trainings_id')->references('id')->on('cg_trainings')->onDelete('cascade');
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
        Schema::dropIfExists('cg_trainings_photos');
    }
}
