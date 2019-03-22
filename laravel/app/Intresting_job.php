<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intresting_job extends Model
{

public $timestamps = true;    
protected $fillable = ['industry','location','profession_adequate','plan_to_meet_qualifications','details','experience','min_salary','intresting_courses','youth_id'];

protected $casts = [
      'industry' => 'array',
      'location' => 'array',
      'intresting_courses' => 'array'
   ];

public function youths(){
	return $this->belongsTo('App\Youth');
}

}
