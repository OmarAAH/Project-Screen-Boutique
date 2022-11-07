<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Size;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->swiftBicNumber(),
            'quantity' =>  $this->faker->numberBetween(100, 500),
            'price' => $this->faker->randomFloat(null, 2, 100),
            'returns' => $this->faker->numberBetween(1, 200),
            'recycling' => $this->faker->numberBetween(1, 200),
            'color_id' => Color::all()->random()->id,
            'type_id' => Type::all()->random()->id,
            'size_id' => Size::all()->random()->id,
            'removal_status' => $this->faker->randomElement([true, false]),
        ];
    }
}
