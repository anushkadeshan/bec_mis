<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class Resourse_person extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;
	public $timestamps = true;
    protected $fillable = ['name','profession','institute','cv'];
}
