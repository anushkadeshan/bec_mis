<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwarenessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awareness', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->string('dsd');
            $table->string('dm_name');
            $table->string('title_of_action');
            $table->string('activity_code');
            $table->string('program_date')->nullable();
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('venue')->nullable();
            $table->string('cost')->nullable();
            $table->string('male')->nullable();
            $table->string('female')->nullable();
            $table->string('pwd-male')->nullable();
            $table->string('pwd-female')->nullable();
            $table->text('mode_of_awareness')->nullable();
            $table->text('topics')->nullable();
            $table->text('deliverables')->nullable();
            $table->string('exposure_visit')->nullable();
            $table->text('palce')->nullable();
            $table->text('demonstraion')->nullable();
            $table->text('matters_discussed')->nullable();
            $table->text('any_concerns')->nullable();
            $table->string('attendance')->nullable();
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
        Schema::dropIfExists('awareness');
    }
}
