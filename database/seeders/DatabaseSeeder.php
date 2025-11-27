<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '9999999999',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
        ]);
        Role::insert([
            [
                'name'       => 'admin',
                'guard_name' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
        $i = 0;

        $permissionArray[$i]['name']       = 'dashboard';
        $permissionArray[$i]['guard_name'] = 'admin';
        $i++;

        $permissionArray[$i]['name']       = 'role_view';
        $permissionArray[$i]['guard_name'] = 'admin';
        $i++;

        $permissionArray[$i]['name']       = 'role_create';
        $permissionArray[$i]['guard_name'] = 'admin';
        $i++;

        $permissionArray[$i]['name']       = 'role_permission';
        $permissionArray[$i]['guard_name'] = 'admin';
        $i++;

        $permissionArray[$i]['name']       = 'user_view';
        $permissionArray[$i]['guard_name'] = 'admin';
        $i++;

        $permissionArray[$i]['name']       = 'user_create';
        $permissionArray[$i]['guard_name'] = 'admin';
        $i++;

        $permissionArray[$i]['name']       = 'user_edit';
        $permissionArray[$i]['guard_name'] = 'admin';
        $i++;
        Permission::insert($permissionArray);

        $role = Role::find(1);
        if (!blank($role)) {
            $role->givePermissionTo(Permission::all());
        }
        $user = Admin::find(1);
        // $role = Role::find(1);
        if (!blank($user) && !blank($role)) {
            $user->assignRole($role->name);
        }
        $user->givePermissionTo(Permission::all());
    }
}
