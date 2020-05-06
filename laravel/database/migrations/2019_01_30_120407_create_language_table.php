<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('reading_tamil')->default(0)->nullable();
            $table->boolean('reading_sinhala')->default(0)->nullable();
            $table->boolean('reading_english')->default(0)->nullable();
            $table->boolean('speaking_tamil')->default(0)->nullable();
            $table->boolean('speaking_sinhala')->default(0)->nullable();
            $table->boolean('speaking_english')->default(0)->nullable();
            $table->boolean('writing_tamil')->default(0)->nullable();
            $table->boolean('writing_sinhala')->default(0)->nullable();
            $table->boolean('writing_english')->default(0)->nullable();
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
        Schema::dropIfExists('language');
    }
}
