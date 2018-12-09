<?php

namespace App\Policies;

use App\User;
use App\userRoles;
use Illuminate\Auth\Access\HandlesAuthorization;

class userPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user roles.
     *
     * @param  \App\User  $user
     * @param  \App\userRoles  $userRoles
     * @return mixed
     */
    public function view(User $user, userRoles $userRoles)
    {
        //
    }

    /**
     * Determine whether the user can create user roles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user roles.
     *
     * @param  \App\User  $user
     * @param  \App\userRoles  $userRoles
     * @return mixed
     */
    public function update(User $user, userRoles $userRoles)
    {
        //
    }

    /**
     * Determine whether the user can delete the user roles.
     *
     * @param  \App\User  $user
     * @param  \App\userRoles  $userRoles
     * @return mixed
     */
    public function delete(User $user, userRoles $userRoles)
    {
        //
    }

    /**
     * Determine whether the user can restore the user roles.
     *
     * @param  \App\User  $user
     * @param  \App\userRoles  $userRoles
     * @return mixed
     */
    public function restore(User $user, userRoles $userRoles)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user roles.
     *
     * @param  \App\User  $user
     * @param  \App\userRoles  $userRoles
     * @return mixed
     */
    public function forceDelete(User $user, userRoles $userRoles)
    {
        //
    }
}
