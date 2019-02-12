<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYouthCommonDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youth_common_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('smart_phone');
            $table->string('training');;
            $table->string('when');
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
        Schema::dropIfExists('youth_common_details');
    }
}
