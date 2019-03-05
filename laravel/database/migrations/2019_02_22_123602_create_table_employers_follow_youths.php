<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmployersFollowYouths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers_follow_youths', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('youth_id')->nullable();
            $table->foreign('youth_id')->references('id')->on('youths')->onDelete('cascade');
            $table->unsignedInteger('employer_id')->nullable();
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
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
        //
    }
}
