<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\StorageLocation;
use App\Models\Unit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(config('defaults.ingredients'))
            ->sort()
            ->each(function (array $ingredient): void {
                $payload = [
                    'name' => $ingredient['name'],
                    'unit_id' => $this->getUnit($ingredient)->id,
                    'storage_location_id' => $this->getLocation($ingredient)->id,
                ];

                Ingredient::create($payload);
            });
    }

    public function getUnit(array $ingredient): Unit
    {
        try {
            return Unit::where('label', $ingredient['unit'])->firstOrFail();
        } catch (ModelNotFoundException $th) {
            Log::warning("Unable to find Unit", ['ingredient' => $ingredient, 'error' => $th->getMessage()]);
            return Unit::where(config('fallback.unit'))->first();
        }
    }

    public function getLocation(array $ingredient): StorageLocation
    {
        try {
            return StorageLocation::where('name', $ingredient['location'])->firstOrFail();
        } catch (ModelNotFoundException $th) {
            Log::warning("Unable to find StorageLocation", ['ingredient' => $ingredient, 'error' => $th->getMessage()]);
            return StorageLocation::where(config('fallback.storage-location'))->first();
        }
    }
}
