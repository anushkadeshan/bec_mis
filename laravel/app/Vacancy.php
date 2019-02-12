<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Youth;


class Vacancy extends Model
{
	public $timestamps = true;
    protected $fillable = ['title','description','job_type','industry','business_function','location','district','salary','total_vacancies','dedline','min_qualification','specializaion','skills','gender','user_id','employer_id'];

    public function employer(){
    	return $this->belongsTo('App\Employer');
    }

    public function youths(){
        return $this-> belongsToMany(Youth::class,'youths_vacancies');
    }
}
