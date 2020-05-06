<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class Result extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;
	public $timestamps = true;
    protected $fillable = ['ol_year', 'ol_attempt',	'ol_pass_or_fail',	'al_year',	'al_attempt','al_pass_or_fail','stream','degree',	'pass_out_year','medium','grade','university','other_professional_qualifications','youth_id','added_by'];

    public function youth(){
    	return $this->belongsTo('App\Youth');
    }
}
