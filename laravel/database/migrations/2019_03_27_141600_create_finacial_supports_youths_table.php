<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinacialSupportsYouthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finacial_supports_youths', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('youth_id')->nullable();
            $table->foreign('youth_id')->references('id')->on('youths')->onDelete('cascade');
            $table->integer('approved_amount')->nullable();
            $table->integer('installments')->nullable();
            $table->unsignedInteger('finacial_support_id')->nullable();
            $table->foreign('finacial_support_id')->references('id')->on('finacial_supports')->onDelete('cascade');
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
        Schema::dropIfExists('finacial_supports_youths');
    }
}
