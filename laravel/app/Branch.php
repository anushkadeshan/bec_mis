<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CareerGuidance;

use OwenIt\Auditing\Contracts\Auditable;

class Branch extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['name','ext'];

    public function youths(){
    	return $this->hasMany('App\Youth');
    }

    public function career_guidances(){
    	return $this->belongsToMany(CareerGuidance::class, 'branches_careerGuidances');
    }
}
