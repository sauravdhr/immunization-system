<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('centers', function (Blueprint $table) {
            $table->increments('center_no');
            $table->string('center_name', 32);
            $table->string('location', 150);
            $table->string('district', 32);
            $table->string('contact_no', 32);
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
        Schema::drop('centers');
    }
}
