<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

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
    public function definition()
    {

        return [
                'title' => $this->faker->unique()->name(),
                'description'=> $this->faker->text(),
                'image' =>'762cedf5ec60d6ac0d74282f50ebec6a.png',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),

        ];
    }
}
