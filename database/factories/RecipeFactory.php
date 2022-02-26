<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    public string $class = Recipe::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph(2),
        ];
    }
}
