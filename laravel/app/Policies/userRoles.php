<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class userRoles
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function superAdmin($user){
        if($user->isAdmin == 1){
            return true;
        }

        else{
            return false;
        }
    }
}


