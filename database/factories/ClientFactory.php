<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Design;
use App\Models\State;
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
            'company_name' => $this->faker->company(),
            'first_name_contact' => $this->faker->firstName(),
            'last_name_contact' => $this->faker->lastName(),
            'phone_contact' => $this->faker->phoneNumber(),
            'branch' => $this->faker->word(),
            'address' => $this->faker->address(),
            'state_id' => State::all()->random()->id,
            'city_id' => City::all()->random()->id,
            'removal_status' => $this->faker->randomElement([true, false]),
        ];
    }
}
