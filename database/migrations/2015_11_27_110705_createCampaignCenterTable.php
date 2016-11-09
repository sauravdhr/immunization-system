<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignCenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('campaigncenters', function (Blueprint $table) {
            $table->increments('cc_no');
            $table->integer('campaign_no');
            $table->integer('center_no');
            $table->string('ho_id',32);
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
       Schema::drop('campaigncenters');

    }
}
