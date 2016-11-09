<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('campaign_no');
            $table->string('campaign_name', 32);
            $table->string('cho_id', 32);
            $table->string('vaccine_name', 32);
            $table->date('campaign_date');
            $table->integer('start_age');
            $table->integer('end_age');
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
        Schema::drop('campaigns');
    }
}
