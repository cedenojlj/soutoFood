<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     * 
     */

     protected $model = Product::class;


    public function definition(): array
    {
        return [
            //
            'itemnumber' => fake()->swiftBicNumber(),
		'name' => fake()->name(),
		'description' => fake()->text($maxNbChars = 50),  
		'upc' => fake()->swiftBicNumber(),
		'pallet' => fake()->numberBetween($min = 1, $max = 50),
		'price' => fake()->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 20), // 48.8932,
		'user_id' => fake()->numberBetween($min = 1, $max = 3),
        //'user_id' => 2,

        ];
    }
}
