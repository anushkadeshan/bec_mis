<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class Institute extends Model
{
	public $timestamps = true;
    protected $fillable = ['name', 'location', 'address', 'contact_person', 'phone','email','is_registerd','reg_no','type','added_by'];

    public function courses(){
    	return $this->belongsToMany(Course::class,'courses_institutes');
    }
}
