<?php

namespace App\Actions;

use App\Models\Ingredient;
use Illuminate\Support\Collection;

class SortIngredientsByLocation implements Action
{
    public function execute(Collection $ingredients): Collection
    {
        $ingredients->pluck('storageLocation');
        $output = $ingredients->mapToGroups(function (Ingredient $ingredient) {
            return [$ingredient->storageLocation->name => $ingredient];
        });

        return $output;
    }
}