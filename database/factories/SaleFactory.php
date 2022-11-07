<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Delivery;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => $this->faker->dateTime('2014-02-25 08:37:17'),
            'sold' => $this->faker->numberBetween(1, 200),
            'total' => $this->faker->randomFloat(null, 1, 100),
            'client_id' => Client::all()->random()->id,
            'design_id' => Delivery::all()->random()->id,
            'employee_id' => Employee::all()->random()->id,
            'product_id' => Product::all()->random()->id,
            'delivery_id' => Delivery::all()->random()->id
        ];
    }
}
