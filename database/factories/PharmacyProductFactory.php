<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class PharmacyProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
                'pharmacy_id'=> $faker->numberBetween($min = 1, $max = 20000),
                'product_id' => $faker->numberBetween($min = 1, $max = 50000),
                'price'      => $faker->numberBetween($min = 1, $max = 500),
                'quantity'   => $faker->numberBetween($min = 1, $max = 500),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
        ];
    }
}
