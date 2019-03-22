<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotCgImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tot_cg_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('images')->nullable();
            $table->unsignedInteger('tot_cg_id')->nullable();
            $table->foreign('tot_cg_id')->references('id')->on('tot_cg')->onDelete('cascade');
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
        Schema::dropIfExists('tot_cg_images');
    }
}
