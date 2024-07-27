<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Client;
use Faker\Factory as Faker;
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
        $faker = Faker::create();
        $currentDate = now(); // Mendapatkan tanggal dan waktu saat ini
        $deadline = $faker->dateTimeBetween($currentDate->subDays(30), $currentDate->addDays(30))->format('Y-m-d');
        return [
            'title' => $this->faker->word(rand(3, 5), true),
            'description' => $this->faker->paragraph(),
            'user_id' => User::pluck('id')->random(),
            'client_id' => Client::pluck('id')->random(),
            'deadline' => $this->faker->date(),
            'status' => $this->faker->randomElement(['open', 'close','done','in progress']),
        ];
    }
}
