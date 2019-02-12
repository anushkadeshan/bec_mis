<?php

namespace App;
use App\Youth;
use App\Branch;

use Illuminate\Database\Eloquent\Model;

class CareerGuidance extends Model
{
    protected $fillable = ['district','ds_division','gn_division','date','time','venue','male',	'female','resourse_person'];

    public function youths(){
    	return $this->belongsToMany(Youth::class, 'youths_career_guidances');
    }

    public function branches(){
    	return $this->belongsToMany(Branch::class, 'branches_careerGuidances');
    }
}
