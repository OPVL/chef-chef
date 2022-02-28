<?php

namespace App\Actions;

use App\Models\Recipe;

class CreateRecipe implements Action
{
    public function execute(array $attributes): Recipe
    {
        $recipe = Recipe::create($attributes);

        return $recipe;
    }
}
