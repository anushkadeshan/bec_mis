<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=[ 'name','slug','permissions',];

    protected $casts = [
        'permissions' => 'array',
    ];
    
    //defining many to many relationship with User table
    public function users()
    {
    	return $this->belongsToMany(User::class,'roles_users'); 
    }

    public function hasAccess(array $permissions) : bool
    {
       foreach($permissions as $permission){
            if($this->hasPermission($permission)){
                return true;
            }
       }
       return false;
    }

    public function hasPermission(string $permission) : bool
    {
    	return $this->permissions[$permission] ?? false;
    	Log::info($permissions);
    }		
}
