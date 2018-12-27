<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
	use Notifiable;

    protected $fillable=['name','address','company_type', 'industry','user_id','phone' , 'email'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function vacancies(){
    	return $this->hasMany('App\Vacancy');
    }

}
