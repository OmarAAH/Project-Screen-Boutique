<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Designer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DesignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'design' => $this->faker->imageUrl(),
            'design_title' => $this->faker->word(),
            'status' => $this->faker->randomElement([true, false]),
            'designer_id' => Designer::all()->random()->id,
            'client_id' => Client::all()->random()->id,
            'removal_status' => $this->faker->randomElement([true, false]),
        ];
    }
}
