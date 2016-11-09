<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('patient_no');
            $table->string('id', 32)->unique();
            $table->string('password', 32);
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('father_name', 32);
            $table->string('mother_name', 32);
            $table->string('gender',10);
            $table->date('date_of_birth');
            $table->string('age',40);
            $table->string('mobile_no',20);
            $table->string('address',60);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::drop('patients');
    }
}
