<?php

    use Illuminate\Database\Seeder;
    Use App\Role;
    class rolerSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $super_admin = Role::create([
                'name'        => 'Super Admin',
                'slug'        => 'super admin',
                'permissions' => json_encode([
                    'create-user' => true,
                    'update-user' => true,
                    'update-user' => true,
                    'activate-user' => true,
                    'view-user'  => true,
                    
                ]),
            ]);
            $admin = Role::create([
                'name'        => 'Admin',
                'slug'        => 'admin',
                'permissions' => json_encode([
                    'view-user'  => true,
                ]),
            ]);

            $guest = Role::create([
                'name'        => 'Guest',
                'slug'        => 'guest',
                'permissions' => json_encode([
                    'view-user'  => true,
                ]),
            ]);
        }
    }
