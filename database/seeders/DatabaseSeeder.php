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

        $this->call(RolePermissionSeeder::class);
        $this->call(UserSeeder::class);
        \App\Models\Client::factory(20)->create();
        \App\Models\Project::factory(10)->create();
        \App\Models\Task::factory(10)->create();

    }
}
