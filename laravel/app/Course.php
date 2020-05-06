<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Institute;
use App\Youth;

use OwenIt\Auditing\Contracts\Auditable;

class Course extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;
	public $timestamps = true;
	
    protected $fillable = ['name', 'duration', 'course_fee', 'course_type',	'standard',	'course_time', 'course_catogery', 'medium', 'min_qualification','added_by','embeded_softs_skills'];
 
    public function institutes(){
    	return $this->belongsToMany(Institute::class,'courses_institutes');
    }

    public function youths(){
    	return $this->belongsToMany(Youth::class,'youths_courses');
    }
}
