<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacementsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placements_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('images')->nullable();
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
        Schema::dropIfExists('placements_photos');
    }
}
