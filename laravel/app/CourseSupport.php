<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Youth;

use OwenIt\Auditing\Contracts\Auditable;

class CourseSupport extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;
    public $timestamps = true;

    protected  $fillable = ['district',	'dsd',	'dm_name',	'title_of_action',	'activity_code',	'program_date',	'institute_id',	'institutional_review',	'course_id',	'start_date',	'end_date',	'total_male',	'total_female',	'pwd_male',	'pwd_female',	'review_report',	'branch_id'];

	public function youths(){
        return $this-> belongsToMany(Youth::class,'course_supports_youth');
	} 

	
}
