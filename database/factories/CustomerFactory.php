<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), 
            'cedula' => fake()->unique()->regexify('[0-4]{8}'),  
            'email' => fake()->unique()->safeEmail(), 
            'phone' => fake()->phoneNumber(), 
            'address' => fake()->streetAddress(),
            'status' => fake()->boolean()
        ];
    }
}
