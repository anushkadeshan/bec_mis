<?php

namespace App;
use App\Youth;
use App\Branch;

use Illuminate\Database\Eloquent\Model;

class CareerGuidance extends Model
{
	public $timestamps = true;

    protected $fillable = ['district','dsd','gnd','dm_name','title_of_action','activity_code','date','time_start','time_end',	'venue','program_cost','total_male','total_female','pwd_male','pwd_female','resourse_person_id','mode_of_conduct',	'topics','deliverables','attendance','branch_id'];

    public function youths(){
    	return $this->belongsToMany(Youth::class, 'youths_career_guidances');
    }

    public function branches(){
    	return $this->belongsToMany(Branch::class, 'branches_careerGuidances');
    }
}
