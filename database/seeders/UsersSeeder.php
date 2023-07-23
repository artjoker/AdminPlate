<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersSeeder.
 */
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $admin */
        $admin = User::factory()->createOne([
            'name'     => 'Admin',
            'password' => bcrypt('secret'),
            'email'    => 'admin@example.com',
            'active'   => true,
        ]);

        /** @var Role $role */
        $role = Role::where('name', User::SUPERADMIN)->first();
        $admin->assignRole($role);

        /** @var User $manager */
        $manager = User::factory()->createOne([
            'name'     => 'Manager',
            'password' => bcrypt('secret'),
            'email'    => 'manager@example.com',
            'active'   => true,
        ]);

        /** @var Role $role */
        $role = Role::where('name', 'Manager')->first();
        $manager->assignRole($role);
        $admin->assignRole($role);
    }
}
