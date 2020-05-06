<?php

namespace App;
use App\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Cache;
use Laravel\Passport\HasApiTokens;

use OwenIt\Auditing\Contracts\Auditable;
   
    
class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasApiTokens, Notifiable;
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','isActive','isAdmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    //defining many to many relationship with roles table
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users');
    }

    public function hasAccess(array $permissions) 
    {
       foreach($this->roles as $role){
            if($role->hasAccess($permissions)){
                return true;
            }
       }
       return false;
    }
    public function inRole($roleSlug)
    {
        return $this->roles()->where('slug',$roleSlug)->count()==1;
    }

    public function is($roleName)
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == $roleName)
            {
                return true;
            }
        }

        return false;
    }

    public function isOnline(){
        return Cache::has('user-is-online-'.$this->id);
    }

     public function receivesBroadcastNotificationsOn()
    {
        return 'App.User.'.$this->id;
    }
}
