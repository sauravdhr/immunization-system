<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Model class for database table events.
*/
class Event extends Model
{
    public $timestamps = false;
    protected $table = 'events';
    protected $fillable = array('cc_no','ha_no');
}
