<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Factory as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pharmacy>
 */
class PharmacyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->unique()->name(),
            'address' => $this->faker->unique()->address(),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),


        ];
    }
}
