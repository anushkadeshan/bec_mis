<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
  protected $fillable = ['cg', 'vt', 'prof', 'soft_skills', 'jobs','youth_id'];

  public function youth(){
  	return $this->belongsTo('App\Youth');
  }

}
