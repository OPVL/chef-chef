<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UnitFactory extends Factory
{
    public function __construct()
    {
        $this->config = Collect(config('units.defaults'));
    }

    public function definition(): array
    {
        $name = $this->faker->word();
        return [
            'name' => $name,
            'label' => Str::limit($name, 2),
        ];
    }
}
