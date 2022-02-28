<?php

namespace Database\Factories;

use App\Models\StorageLocation;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'unit_id' => 1,
            'storage_location_id' => 1,
        ];
    }

    public function location(StorageLocation $storageLocation)
    {
        return $this->state(function (array $attributes) use ($storageLocation) {
            return [
                'storage_location_id' => $storageLocation->id,
            ];
        });
    }

    public function unit(Unit $unit)
    {
        return $this->state(function (array $attributes) use ($unit) {
            return [
                'unit_id' => $unit->id,
            ];
        });
    }
}
