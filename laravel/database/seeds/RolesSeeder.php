<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name'        => 'Admin',
            'slug'        => 'admin',
            'permissions' => json_encode([
                'create-Employer' => true,
                'delete-Employer' => true,
                'view-Employer' => true,
                'update-Employer' =>true,
                'view-vacancies' => true,
                'edit-vacancies' =>true,
                'create-vacancies' =>true,
                'delete-vacancies' => true,
                'apply-vacancy' => true,
            ]),
        ]);
        $branch = Role::create([
            'name'        => 'Branch',
            'slug'        => 'branch',
            'permissions' => json_encode([
                'create-Employer' => true,
                'view-Employer' => true,
                'update-Employer' =>true,
                'view-vacancies' => true,
                'edit-vacancies' =>true,
                'create-vacancies' =>true,
                'delete-vacancies' => true,
            ]),
        ]);

        $employer = Role::create([
            'name'        => 'Employer',
            'slug'        => 'employer',
            'permissions' => json_encode([
                'view-Employer-Profile' => true,
                'view-vacancies' => true,
                'edit-vacancies' =>true,
                'create-vacancies' =>true,
                'delete-vacancies' => true,
            ]),
        ]);

        $trainers = Role::create([
            'name'        => 'Trainers',
            'slug'        => 'trainers',
            'permissions' => json_encode([         
                'view-Employer' => true,
            ]),
        ]);

        $youth = Role::create([
            'name'        => 'Youth',
            'slug'        => 'youth',
            'permissions' => json_encode([         
                'view-Employer' => true,
                'view-vacancies' => true,
                'apply-vacancy' => true,

            ]),
        ]);

        $guest = Role::create([
            'name'        => 'Guest',
            'slug'        => 'guest',
            'permissions' => json_encode([         
                'view-Employer' => true,
                'view-vacancies' => true,
                'apply-vacancy' => true,
            ]),
        ]);
    }
}
