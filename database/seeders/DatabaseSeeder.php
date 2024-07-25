<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(30)->create();

        \App\Models\User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'i am',
            'password' => bcrypt('admin'),
            'phone_number' => '0812216543213',
            'email' => 'admin@example.com',
            'address' => 'address admin',
        ]);


        \App\Models\Client::factory(20)->create();
        \App\Models\Project::factory(10)->create();
        \App\Models\Task::factory(10)->create();
    }
}
