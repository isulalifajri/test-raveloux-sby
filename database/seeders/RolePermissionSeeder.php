<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'store']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'detail']);
        Permission::create(['name' => 'delete']);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo(['create','store','edit','update','detail','delete']);

        $roleUser = Role::findByName('user');
        $roleUser->givePermissionTo(['detail']);

    }
}
