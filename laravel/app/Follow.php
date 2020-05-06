<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class Follow extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;
	public $timestamps = true;
    protected $fillable = ['course_id',	'institute_id',	'status',	'completed_at',	'youth_id'];

    public function youth(){
    	return $this->belongsTo('App\Youth');
    }
}
