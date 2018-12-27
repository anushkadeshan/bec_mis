<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Vacancy extends Model
{
    protected $fillable = ['title','description','job_type','industry','business_function','location','district','salary','total_vacancies','dedline','min_qualification','specializaion','skills','gender','user_id','employer_id'];

    public function employer(){
    	return $this->belongsTo('App\Employer');
    }
}
