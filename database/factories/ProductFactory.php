<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(10000, 100000),
            'stock' => $this->faker->numberBetween(5, 50),
            'image' => 'https://via.placeholder.com/150', // placeholder dummy
        ];
    }
}
