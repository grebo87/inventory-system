<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Catalog\Currency;
use App\Models\Catalog\MeasurementUnit;
use App\Models\Category;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => fake()->randomElement(Category::pluck('id')),
            'brand_id' => fake()->randomElement(Brand::pluck('id')),
            'warehouse_id' => fake()->randomElement(Warehouse::pluck('id')),
            'name' => fake()->unique()->realText($maxNbChars = 10),
            'code' => fake()->unique()->randomNumber(6),
            'description' => fake()->text($maxNbChars = 50),
            'measurement_unit_id' => fake()->randomElement(MeasurementUnit::pluck('id')),
            'currency_id' => fake()->randomElement(Currency::pluck('id')),
            'unit_price' => fake()->randomFloat(2, 1, 1000),
            'initial_stock' => fake()->randomNumber(4),
            'date_expiration' =>  Carbon::now()->addMonths(fake()->randomDigit(2)),  
        ];
    }
}
