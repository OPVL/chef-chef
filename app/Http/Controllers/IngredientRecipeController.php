<?php

namespace App\Http\Controllers;

use App\Actions\SortIngredientsByLocation;
use App\Http\Requests\CreateIngredientRecipe;
use App\Http\Requests\UpdateIngredientRecipe;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IngredientRecipeController extends Controller
{
    public function __construct(protected SortIngredientsByLocation $sortAction)
    {
    }

    public function create(Recipe $recipe): View
    {
        return view('recipe.ingredient.create', [
            'recipe' => $recipe,
            'groups' => $this->sortAction->execute(Ingredient::with('storageLocation')->get()),
        ]);
    }

    public function edit(Recipe $recipe): View
    {
        return view('recipe.ingredient.edit', [
            'recipe' => $recipe,
            'groups' => $this->sortAction->execute($recipe->ingredients()->with('storageLocation')->get()),
            'units' => Unit::all(),
        ]);
    }

    public function update(Recipe $recipe, UpdateIngredientRecipe $request): RedirectResponse
    {
        dd($request->validated());

        [
            'ingredient_id' => '',
            'recipe_id' => $recipe->id,
            'quantity'  => $request->quantity[$ingredient->id],
            'unit_id' => $request->unit[$ingredient->id],
        ];

        return redirect()->route('recipe.get', $recipe);
    }

    public function store(Recipe $recipe, CreateIngredientRecipe $request): RedirectResponse
    {
        $recipe->ingredients()->attach($request->validated()['ingredient']);

        return redirect()->route('recipe.ingredient.edit', $recipe);
    }
}
