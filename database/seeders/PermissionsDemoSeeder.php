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
//        Permission::create(['name' => 'edit articles']);
//        Permission::create(['name' => 'delete articles']);
//        Permission::create(['name' => 'publish articles']);
//        Permission::create(['name' => 'unpublish articles']);

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
