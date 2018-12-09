<?php

namespace App\Providers;

use App\Users;
use App\Policies\userRoles;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => userRoles::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPostPolicies();   
    }

    public function registerPostPolicies()
    {
        Gate::define('view-user', function($user, User $users){
            $user->hasAccess(['view-user']);
        });

        Gate::define('activate-user', function($user){
            $user->hasAccess(['activate-user']);
        });
    }
}
