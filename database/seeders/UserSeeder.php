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

        foreach ($users as $user) {
            $user->assignRole('user');
        }

        $admin = User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'i am',
            'password' => bcrypt('admin'),
            'phone_number' => '0812216543213',
            'email' => 'admin@example.com',
            'address' => 'address admin',
        ]);

        $admin->assignRole('admin');
    }
}
