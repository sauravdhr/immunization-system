<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('vacc_record', function (Blueprint $table) {
            $table->increments('record_no');
            $table->string('patient_id', 32);
            $table->string('healthasst_id', 32);
            $table->string('center', 32);
            $table->date('vacc_date');
            $table->string('vaccine',40);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('vacc_record');
    }
}
