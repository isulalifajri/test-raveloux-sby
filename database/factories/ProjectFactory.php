<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(rand(3, 5), true),
            'description' => $this->faker->paragraph(),
            'user_id' => User::pluck('id')->random(),
            'client_id' => Client::pluck('id')->random(),
            'deadline' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(['open', 'close','done','in progress']),
        ];
    }
}
