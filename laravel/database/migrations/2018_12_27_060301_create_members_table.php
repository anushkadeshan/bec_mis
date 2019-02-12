<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('relationship');
            $table->string('birth_date')->nullable();
            $table->string('nic')->nullable();
            $table->string('occupation')->nullable();
            $table->string('nature_of_job')->nullable();
            $table->integer('monthly_income')->default(0)->nullable();
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
        Schema::dropIfExists('members');
    }
}
