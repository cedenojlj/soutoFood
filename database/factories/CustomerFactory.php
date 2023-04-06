<?php

namespace Database\Factories;

use App\Models\Customer;
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

     protected $model = Customer::class;


    public function definition(): array
    {
        return [
            'name'=> fake()->name(),
            'email'=> fake()->unique()->safeEmail(),
            'email2'=> fake()->unique()->safeEmail(),
            'emailRep'=> fake()->unique()->safeEmail(),
            'pin'=> 1234
        ];
    }
}
