<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
* Model class for database table notifications.
*/
class Notification extends Model
{
    //
    public $timestamps = false;
    protected $table = 'notifications';
    protected $fillable = array('campaign_no','msg','msg_date');
}
