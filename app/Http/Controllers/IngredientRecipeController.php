<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Http\Requests\CreateIngredientRecipe;
use App\Models\Ingredient;
use App\Models\StorageLocation;

class IngredientRecipeController extends Controller
{
    public function create(Recipe $recipe)
    {
        $ingredients = Ingredient::all();

        $locations = StorageLocation::select()->whereHas('ingredients')->with('ingredients')->get();

        return view('recipe.ingredient.create', ['recipe' => $recipe, 'locations' => $locations]);
    }

    public function edit(Recipe $recipe)
    {
        return view('recipe.ingredient.edit', ['recipe' => $recipe]);
    }

    public function store(Recipe $recipe, CreateIngredientRecipe $request)
    {
        $recipe->ingredients()->attach($request->validated()['ingredient']);

        return redirect()->route('recipe.ingredient.edit', $recipe);
    }
}
