<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Model class for database table campaigncenters.
*/
class CampaignCenter extends Model
{
    //
    public $timestamps = false;
    protected $table = 'campaigncenters';
    protected $fillable = array('campaign_no','center_no','ho_id');
}
