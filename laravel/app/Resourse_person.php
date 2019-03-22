<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resourse_person extends Model
{
	public $timestamps = true;
    protected $fillable = ['name','profession','institute','cv'];
}
