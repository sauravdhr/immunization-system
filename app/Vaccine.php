<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
* Model class for database table vaccines that works as a vaccine inventory.
*/


class Vaccine extends Model
{
   	public $timestamps = false;
    protected $table = 'vaccines';
    protected $fillable = array('vaccine_no','vaccine_name','inventory_name','total_vials','available_vials','manufacturer','mfg_date','exp_date','vfc');
    
    public function setExpDate($value) {
       $this->attributes['exp_date'] = Carbon::createFromFormat('d/m/Y', $value);
   	}
   	public function setMfgDate($value) {
       $this->attributes['mfg_date'] = Carbon::createFromFormat('d/m/Y', $value);
   	}
   	
}
