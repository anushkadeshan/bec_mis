<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
   public $timestamps = true;

   protected $fillable = ['task','due_date','severity'];
}
