<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYouthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youths', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('full_name');
            $table->string('gender');
            $table->string('nic');
            $table->string('birth_date');
            $table->string('driving_licence');
            $table->string('maritial_status');
            $table->string('nationality');
            $table->string('disability');
            $table->text('reason')->nullable();
            $table->string('highest_qualification');
            $table->unsignedInteger('family_id');
            $table->foreign('family_id')->references('id')->on('families');
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
        Schema::dropIfExists('youths');
    }
}
