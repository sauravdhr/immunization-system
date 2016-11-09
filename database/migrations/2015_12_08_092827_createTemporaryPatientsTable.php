<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_employees', function (Blueprint $table) {
            $table->increments('emp_no');
            $table->string('id', 32)->unique();
            $table->string('password', 32);
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('gender',10);
            $table->string('designation',30);
            $table->string('mobile_no',20);
            $table->string('address',60);
            $table->string('email',30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('temp_employees');
    }
}
