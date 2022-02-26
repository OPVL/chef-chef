<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    public function __construct()
    {
        $this->config = Collect(config('units.defaults'));
    }

    public function definition()
    {
        $name = $this->faker->word();
        return [
            'name' => $name,
            'display' => Str::limit($name, 2),
        ];
    }
}
