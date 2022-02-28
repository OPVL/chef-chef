<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CuisineFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->country(),
            'description' => $this->faker->paragraph(2),
        ];
    }
}
