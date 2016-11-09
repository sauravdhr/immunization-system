<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->increments('vaccine_no');
            $table->string('vaccine_name', 32);
            $table->string('inventory_name', 32);
            $table->integer('total_vials');
            $table->integer('available_vials');
            $table->string('manufacturer', 32);
            $table->date('mfg_date');
            $table->date('exp_date');
            $table->string('vfc', 5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vaccines');
    }
}
