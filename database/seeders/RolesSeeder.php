<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

/**
 * Class RolesSeeder.
 */
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @throws \Throwable
     * @return void
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        DB::transaction(function () {
            //clients
            Permission::create(['name' => 'add clients']);
            Permission::create(['name' => 'view clients']);
            Permission::create(['name' => 'edit clients']);
            Permission::create(['name' => 'delete clients']);
            Permission::create(['name' => 'list clients']);

            //users
            Permission::create(['name' => 'add admins']);
            Permission::create(['name' => 'edit admins']);
            Permission::create(['name' => 'delete admins']);
            Permission::create(['name' => 'list admins']);

            //permissions
            Permission::create(['name' => 'add permissions']);
            Permission::create(['name' => 'edit permissions']);
            Permission::create(['name' => 'delete permissions']);
            Permission::create(['name' => 'list permissions']);

            //roles
            Permission::create(['name' => 'add roles']);
            Permission::create(['name' => 'edit roles']);
            Permission::create(['name' => 'delete roles']);
            Permission::create(['name' => 'list roles']);
        });

        $role = Role::create(['name' => User::SUPERADMIN, 'active' => true]);
        $role->syncPermissions(Permission::all());

        $role = Role::create(['name' => 'Manager', 'active' => true]);
        $role->syncPermissions(Permission::whereIn('name', ['list clients'])->get());
    }
}
