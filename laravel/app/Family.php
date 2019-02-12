<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
	public $timestamps = true;
    protected $fillable = ['district','ds_division','gn_division','head_of_household','nic_head_of_household','address','family_type','total_income','total_members'] ;

    public function youths(){
    	return $this->hasMany('App\Youth');
    }
}
