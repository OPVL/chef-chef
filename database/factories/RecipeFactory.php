<?php

namespace Database\Factories;

use App\Models\Cuisine;
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
            'cuisine_id' => 1,
        ];
    }

    public function cuisine(Cuisine $cuisine): static
    {
        return $this->state(function (array $attributes) use ($cuisine): array {
            return ['cuisine_id' => $cuisine->id];
        });
    }
}
