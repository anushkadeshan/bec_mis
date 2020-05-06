<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCgYouthSelectedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cg_youth_selected', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requirement')->nullable(); 
            $table->integer('male')->nullable(); 
            $table->integer('female')->nullable(); 
            $table->unsignedInteger('career_guidances_id')->nullable();
            $table->foreign('career_guidances_id')->references('id')->on('career_guidances')->onDelete('cascade');
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
        Schema::dropIfExists('cg_youth_selected');
    }
}
