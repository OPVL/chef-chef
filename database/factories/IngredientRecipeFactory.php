<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientRecipeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->number(),
            'unit_id' => 1,
        ];
    }
}
