<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Youth;

use OwenIt\Auditing\Contracts\Auditable;

class Employer extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;
	use Notifiable;
    public $timestamps = true;
    protected $fillable=['name','address','company_type', 'industry','user_id','phone' , 'email','added_by'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function vacancies(){
    	return $this->hasMany('App\Vacancy');
    }

    public function youths(){
        return $this-> belongsToMany(Youth::class,'employers_follow_youths');
    }

}
