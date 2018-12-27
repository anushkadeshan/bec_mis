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
        Gate::define('create-Employer', function($user){
            return $user->hasAccess(['create-Employer']);
        });

        Gate::define('view-Employer', function($user){
            return $user->hasAccess(['view-Employer']);
        });

        Gate::define('delete-Employer', function($user){
            return $user->hasAccess(['delete-Employer']);
        });

        Gate::define('update-Employer', function($user){
            return $user->hasAccess(['update-Employer']);
        });

        Gate::define('view-Employer-Profile', function($user){
            return $user->hasAccess(['view-Employer-Profile']);
        });

        Gate::define('view-vacancies', function($user){
            return $user->hasAccess(['view-vacancies']);
        });
        Gate::define('edit-vacancies', function($user){
            return $user->hasAccess(['edit-vacancies']);
        });

        Gate::define('create-vacancies', function($user){
            return $user->hasAccess(['create-vacancies']);
        });

        Gate::define('delete-vacancies', function($user){
            return $user->hasAccess(['delete-vacancies']);
        });

        Gate::define('apply-vacancy', function($user){
            return $user->hasAccess(['apply-vacancy']);
        });
        
        
    }
}
