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

        Gate::define('admin', function($user){
            return $user->hasAccess(['admin']);
        });

        Gate::define('branch', function($user){
            return $user->hasAccess(['branch']);
        });

        Gate::define('employer', function($user){
            return $user->hasAccess(['employer']);
        });

        Gate::define('youth', function($user){
            return $user->hasAccess(['youth']);
        });

        Gate::define('guest', function($user){
            return $user->hasAccess(['guest']);
        });

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

        Gate::define('view-youth', function($user){
            return $user->hasAccess(['view-youth']);
        });

        Gate::define('add-youth', function($user){
            return $user->hasAccess(['add-youth']);
        });
        Gate::define('delete-youth', function($user){
            return $user->hasAccess(['delete-youth']);
        });
        Gate::define('edit-youth', function($user){
         return $user->hasAccess(['edit-youth']);
         });
        Gate::define('view-institute', function($user){
            return $user->hasAccess(['view-institute']);
        });

        Gate::define('add-institute', function($user){
            return $user->hasAccess(['add-institute']);
        });
        Gate::define('delete-institute', function($user){
            return $user->hasAccess(['delete-institute']);
        });
        Gate::define('edit-institute', function($user){
         return $user->hasAccess(['edit-institute']);
         });

        Gate::define('view-course', function($user){
            return $user->hasAccess(['view-course']);
        });

        Gate::define('add-course', function($user){
            return $user->hasAccess(['add-course']);
        });
        Gate::define('delete-course', function($user){
            return $user->hasAccess(['delete-course']);
        });
        Gate::define('edit-course', function($user){
         return $user->hasAccess(['edit-course']);
         });

        Gate::define('view-activities', function($user){
         return $user->hasAccess(['view-activities']);
         });

        Gate::define('view-youth-profile', function($user){
         return $user->hasAccess(['view-youth-profile']);
         });

        Gate::define('follow-youth', function($user){
         return $user->hasAccess(['follow-youth']);
         });

        Gate::define('follow-employer', function($user){
         return $user->hasAccess(['follow-employer']);
         });

        Gate::define('view-applications', function($user){
         return $user->hasAccess(['view-applications']);
         });

        Gate::define('change-job-status', function($user){
         return $user->hasAccess(['change-job-status']);
         });

        Gate::define('search-youth', function($user){
         return $user->hasAccess(['search-youth']);
         });
        
        Gate::define('view-youths-profile', function($user){
         return $user->hasAccess(['view-youths-profile']);
         });

        Gate::define('view-youth-followers', function($user){
         return $user->hasAccess(['view-youth-followers']);
         });
        Gate::define('view-reports', function($user){
         return $user->hasAccess(['view-reports']);
         });

        Gate::define('view-youth-contacts', function($user){
         return $user->hasAccess(['view-youth-contacts']);
         });
        
        Gate::define('search-institutes', function($user){
         return $user->hasAccess(['search-institutes']);
         });

        Gate::define('youth-search-menu', function($user){
         return $user->hasAccess(['youth-search-menu']);
         });

        Gate::define('admin-dashboard', function($user){
         return $user->hasAccess(['admin-dashboard']);
         });

        Gate::define('branch-dashboard', function($user){
         return $user->hasAccess(['branch-dashboard']);
         });

        Gate::define('employer-dashboard', function($user){
         return $user->hasAccess(['employer-dashboard']);
         });

        Gate::define('trainers-dashboard', function($user){
         return $user->hasAccess(['trainers-dashboard']);
         });

        Gate::define('youth-dashboard', function($user){
         return $user->hasAccess(['youth-dashboard']);
         });

        Gate::define('guest-dashboard', function($user){
         return $user->hasAccess(['guest-dashboard']);
         });

        
    }
}