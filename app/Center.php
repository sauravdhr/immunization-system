<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Model class for database table centers.
*/
class Center extends Model
{
    //
    public $timestamps = false;
    protected $table = 'centers';
    protected $fillable = array('center_name','location','district','contact_no');
    
}
