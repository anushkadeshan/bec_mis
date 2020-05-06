<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class Todo extends Model implements Auditable
{
    
    use \OwenIt\Auditing\Auditable;
   public $timestamps = true;

   protected $fillable = ['task','due_date','severity'];
}
