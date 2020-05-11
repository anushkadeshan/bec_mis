<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotCgParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tot_cg_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('organization')->nullable();
            $table->integer('total_male');
            $table->integer('total_female');
            $table->integer('pwd_male');
            $table->integer('pwd_female');
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
        Schema::dropIfExists('tot_cg_participants');
    }
}
