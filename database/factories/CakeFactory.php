<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CakeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(60),
            'weight' => fake()->numberBetween(1, 1000),
            'price' => fake()->numberBetween(1, 200),
            'available_quantity' => fake()->numberBetween(0, 100),
        ];
    }
}
