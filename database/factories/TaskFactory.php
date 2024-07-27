<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'user_id' => User::pluck('id')->random(),
            'client_id' => Client::pluck('id')->random(),
            'project_id' => Project::pluck('id')->random(),
            'deadline' => $this->faker->date(),
            'status' => $this->faker->randomElement(['open', 'close','done','in progress']),
        ];
    }
}
