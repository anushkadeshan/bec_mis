<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
	public $timestamps = true;
    protected $fillable = ['course_id',	'institute_id',	'status',	'completed_at',	'youth_id'];

    public function youth(){
    	return $this->belongsTo('App\Youth');
    }
}
