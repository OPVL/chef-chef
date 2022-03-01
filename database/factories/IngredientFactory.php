<?php

namespace Database\Factories;

use App\Models\Type;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'unit_id' => 1,
            'type_id' => 1,
        ];
    }

    public function location(Type $type)
    {
        return $this->state(
            function (array $attributes) use ($type) {
                return [
                'type_id' => $type->id,
                ];
            }
        );
    }

    public function unit(Unit $unit)
    {
        return $this->state(
            function (array $attributes) use ($unit) {
                return [
                'unit_id' => $unit->id,
                ];
            }
        );
    }
}
