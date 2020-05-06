<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class Member extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;
	public $timestamps = true;
    protected $fillable = ['name','relationship','birth_date','nic','occupation','nature_of_job','monthly_income','family_id'];


    public function family(){
    	return $this->belongsTo('App/Family');
    }
}
