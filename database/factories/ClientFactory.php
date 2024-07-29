<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::pluck('id')->random(),
            'contact_name' => $this->faker->name(),
            'contact_email' => $this->faker->unique()->safeEmail(),
            'contact_phone_number' => $this->faker->phoneNumber(),
            'company_name' => $this->faker->company(),
            'company_address' => $this->faker->address(),
            'company_city' => $this->faker->city(),
            'company_zip' => $this->faker->postcode(),
            'company_vat' => $this->faker->numberBetween(0, 99999)      
        ];
    }
}
