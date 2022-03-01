<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UnitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'label' => Str::limit($this->faker->word(), 2),
        ];
    }
}
