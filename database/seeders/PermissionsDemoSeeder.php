<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'meetings-access']);
        Permission::create(['name' => 'meeting-delete']);
        Permission::create(['name' => 'meeting-create']);
        Permission::create(['name' => 'meeting-edit']);
        Permission::create(['name' => 'meeting-view']);

        Permission::create(['name' => 'agenda-item-access']);
        Permission::create(['name' => 'agenda-item-create']);
        Permission::create(['name' => 'agenda-item-add-attachment']);
        Permission::create(['name' => 'agenda-item-edit']);
        Permission::create(['name' => 'agenda-item-view']);
        Permission::create(['name' => 'agenda-item-delete']);

        Permission::create(['name' => 'attendance-access']);
        Permission::create(['name' => 'attendance-create']);
        Permission::create(['name' => 'attendance-edit']);
        Permission::create(['name' => 'attendance-view']);
        Permission::create(['name' => 'attendance-delete']);

        Permission::create(['name' => 'meeting-minutes-access']);
        Permission::create(['name' => 'meeting-minutes-create']);
        Permission::create(['name' => 'meeting-minutes-edit']);
        Permission::create(['name' => 'meeting-minutes-view']);
        Permission::create(['name' => 'meeting-minutes-delete']);

        Permission::create(['name' => 'users-access']);
        Permission::create(['name' => 'users-create']);
        Permission::create(['name' => 'users-edit']);
        Permission::create(['name' => 'users-view']);



        Permission::create(['name' => 'committees-access']);
        Permission::create(['name' => 'committees-create']);
        Permission::create(['name' => 'committees-edit']);
        Permission::create(['name' => 'committees-view']);


        Permission::create(['name' => 'view all committee meetings', 'guard_name' => 'web']);
        Permission::create(['name' => 'view own committee meetings', 'guard_name' => 'web']);
        Permission::create(['name' => 'view member committee meetings', 'guard_name' => 'web']);
        Permission::create(['name' => 'create committee meetings', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit committee meetings', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete committee meetings', 'guard_name' => 'web']);


        Permission::create(['name' => 'view all committee meetings agenda', 'guard_name' => 'web']);
        Permission::create(['name' => 'view own committee meetings agenda', 'guard_name' => 'web']);
        Permission::create(['name' => 'view member committee meetings agenda', 'guard_name' => 'web']);
        Permission::create(['name' => 'create committee meetings agenda', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit committee meetings agenda', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete committee meetings agenda', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete committee meetings agenda item', 'guard_name' => 'web']);
        Permission::create(['name' => 'add committee meetings agenda item attachment', 'guard_name' => 'web']);



        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Board Member']);
//        $role1->givePermissionTo('edit articles');
//        $role1->givePermissionTo('delete articles');

        $role2 = Role::create(['name' => 'Company Secretary']);
//        $role2->givePermissionTo('publish articles');
//        $role2->givePermissionTo('unpublish articles');

        $role3 = Role::create(['name' => 'Super-Admin']);
        $role4 = Role::create(['name' => 'President']);
        $role5 = Role::create(['name' => 'Divisional Head']);

        $role6 = Role::create(['name' => 'DH and Committee Secretary','guard_name' => 'web']);

        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Board Member',
            'designation' => 'Board Member',
            'password' => Hash::make('12345678'),
            'email' => 'bm@example.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Company Secretary',
            'designation' => 'Company Secretary',
            'password' => Hash::make('12345678'),
            'email' => 'cs@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin',
            'designation' => 'SA',
            'password' => Hash::make('12345678'),
            'email' => 'sa@example.com',
        ]);
        $user->assignRole($role3);

        $user = \App\Models\User::factory()->create([
            'name' => 'CEO',
            'designation' => 'CEO',
            'password' => Hash::make('12345678'),
            'email' => 'ceo@example.com',
        ]);
        $user->assignRole($role4);


        $user = \App\Models\User::factory()->create([
            'name' => 'Divisional Head',
            'designation' => 'DH',
            'password' => Hash::make('12345678'),
            'email' => 'dh@example.com',
        ]);
        $user->assignRole($role5);
    }

    //php artisan migrate:fresh --seed --seeder=PermissionsDemoSeeder
}