<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pes_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->string('dsd');
            $table->string('gnd');
            $table->string('dm_name');
            $table->string('title_of_action');
            $table->string('activity_code');
            $table->string('date');
            $table->string('responding_officer_name');
            $table->string('responding_officer_des');
            $table->string('responding_officer_contacts');
            $table->text('type_of_services')->nullable();
            $table->string('records');
            $table->integer('male_18_24');
            $table->integer('male_25_30');
            $table->integer('male_30');
            $table->integer('female_18_24');
            $table->integer('female_25_30');
            $table->integer('female_30');
            $table->integer('pwd_male');
            $table->integer('pwd_female');
            $table->string('unit_available');
            $table->string('space_available');
            $table->string('stationary_available');
            $table->string('chairs_available');
            $table->string('tables_available');
            $table->string('cupboards_available');
            $table->string('stationary_items_available');
            $table->text('lack_of_items')->nullable();
            $table->integer('staff')->nullable();
            $table->string('sufficient_staff')->nullable();
            $table->text('additional_staff')->nullable();
            $table->string('vt_database')->nullable();
            $table->string('update_vt')->nullable();
            $table->string('last_updated_vt')->nullable();
            $table->string('job_database')->nullable();
            $table->string('update_job')->nullable();
            $table->string('last_updated_job')->nullable();
            $table->text('reasons_to_not_update')->nullable();
            $table->text('gaps')->nullable();
            $table->integer('branch_id')->nullable();
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
        Schema::dropIfExists('pes_units');
    }
}
