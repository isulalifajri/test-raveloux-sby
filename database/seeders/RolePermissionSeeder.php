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
        // permission users
        Permission::create(['name' => 'create.users']);
        Permission::create(['name' => 'store.users']);
        Permission::create(['name' => 'edit.users']);
        Permission::create(['name' => 'update.users']);
        Permission::create(['name' => 'destroy.users']);

        // permission clients
        $clients = ['create.clients', 'store.clients', 'edit.clients', 'update.clients', 'destroy.clients'];

        foreach ($clients as $client) {
            Permission::create(['name' => $client]);
        }

        // permission projects
        $projects = ['create.projects', 'store.projects', 'edit.projects', 'update.projects', 'destroy.projects'];
        foreach ($projects as $project) {
            Permission::create(['name' => $project]);
        }

        // permission tasks
        $tasks = ['create.tasks', 'store.tasks', 'edit.tasks', 'update.tasks','detail.tasks', 'destroy.tasks'];
        foreach ($tasks as $task) {
            Permission::create(['name' => $task]);
        }


        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        
        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo(['create.users','store.users','edit.users','update.users','destroy.users']);
        $roleAdmin->givePermissionTo(['create.clients','store.clients','edit.clients','update.clients','destroy.clients']);
        $roleAdmin->givePermissionTo(['create.projects','store.projects','edit.projects','update.projects','destroy.projects']);
        $roleAdmin->givePermissionTo(['create.tasks','store.tasks','edit.clients','update.clients','detail.tasks','destroy.tasks']);

        $roleUser = Role::findByName('user');
        $roleUser->givePermissionTo(['detail.tasks']);

    }
}
