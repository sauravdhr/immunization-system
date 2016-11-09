<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticable as AuthenticableTrait;


/**
* Model class for database table temp_employee that holds the temporary employees.
*/


class TempEmployee extends Model
{
    //
    public $timestamps = false;
    protected $table = 'temp_employees';
    protected $fillable = array('id','password','first_name','last_name','gender','designation','mobile_no','address','email');
    protected $hidden = ['password'];
    
}
