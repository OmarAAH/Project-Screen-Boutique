<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $employee = Employee::all();
        return [
            'user' => $this->faker->userName(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
            'role_id' => Role::all()->random()->id,
            'employee_id' => $this->faker->unique()->numberBetween(1, $employee->count()),
            'removal_status' => $this->faker->randomElement([true, false]),
        ];
    }
}
