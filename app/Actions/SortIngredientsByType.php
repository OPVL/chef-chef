<?php

namespace App\Actions;

use App\Models\Ingredient;
use Illuminate\Support\Collection;

class SortIngredientsByType implements Action
{
    public function execute(Collection $ingredients): Collection
    {
        $ingredients->pluck('type');
        $output = $ingredients->mapToGroups(function (Ingredient $ingredient) {
            return [$ingredient->type->name => $ingredient];
        });

        return $output;
    }
}
