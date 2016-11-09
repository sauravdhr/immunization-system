<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
* Model class for database table patients.
*/

class Patient extends Model
{
    //
    public $timestamps = false;
    protected $table = 'patients';
    protected $fillable = array('id','password','first_name','last_name','father_name','mother_name','gender','date_of_birth','mobile_no','address');
    protected $hidden = ['password'];

	/**
	* This function converts string to date format.
	* @param $value containing the string formatted date of patient's birth date.
	*/
    public function setDobAttribute($value){
       $this->attributes['date_of_birth'] = Carbon::createFromFormat('d/m/Y', $value);
   	}
}
