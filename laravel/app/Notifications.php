<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
   protected $fillable=[ 'read_at'];

   protected $casts = [
    'data' => 'array',
   ];
}
