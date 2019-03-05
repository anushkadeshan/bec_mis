<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\CareerGuidance;
use App\Vacancy;
use App\Employer;

class Youth extends Model
{
    public $timestamps = true;
    
    protected $fillable = ['name', 'full_name',	'gender', 'nic'	,'phone','email','birth_date','driving_licence','maritial_status',	'nationality', 'disability','reason','highest_qualification','family_id','added_by','branch_id','user_id'];

    public function family(){
    	return $this->belongsTo('App\Family');
    }

    public function results(){
    	return $this->hasMany('App\Result');
    }

    public function courses(){
    	return $this->belongsToMany(Course::class,'youths_courses');
    }

    public function branch(){
        return $this->belongsTo('App\Branch');
    }

    public function progresses(){
        return $this->hasMany('App\Progress');
    }

    public function career_guidances(){
        return $this->belongsToMany(CareerGuidance::class, 'branches_careerGuidances');
    }

    public function intrestingJobs(){
        return $this->hasMany('App\IntrestingJobs');
    }

    public function vacancies(){
        return $this-> belongsToMany(Vacancy::class,'youths_vacancies');
    }

    public function employers(){
        return $this-> belongsToMany(Employer::class,'employers_follow_youths');
    }

}
