<?php

namespace Database\Factories\Catalog;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->randomElement(['EUR', 'USD', 'VEF']),
            'name' => fake()->unique()->randomElement(['Euro', 'Dólar estadounidense', 'Bolívar venezolano']),
            'symbol' => fake()->unique()->randomElement(['€', '$', 'Bs.']),
            'country'  => fake()->unique()->randomElement(['Unión Europea', 'Estados Unidos', 'Venezuela']),
            'active' => fake()->boolean()
        ];
    }
}
