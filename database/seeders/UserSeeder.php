<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(30)->create();

        foreach ($users as $roleUser) {
            $roleUser->assignRole('user');
            $roleUser->givePermissionTo(['detail.tasks']);
        }

        $roleAdmin = User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'i am',
            'password' => bcrypt('admin'),
            'phone_number' => '0812216543213',
            'email' => 'admin@example.com',
            'address' => 'address admin',
        ]);

        $roleAdmin->assignRole('admin');
        $roleAdmin->givePermissionTo(['create.users','store.users','edit.users','update.users','destroy.users']);
        $roleAdmin->givePermissionTo(['create.clients','store.clients','edit.clients','update.clients','destroy.clients']);
        $roleAdmin->givePermissionTo(['create.projects','store.projects','edit.projects','update.projects','destroy.projects']);
        $roleAdmin->givePermissionTo(['create.tasks','store.tasks','edit.tasks','update.tasks','detail.tasks','destroy.tasks']);


    }
}
