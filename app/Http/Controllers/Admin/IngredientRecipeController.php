<?php

namespace App\Http\Controllers\Admin;

use App\Actions\SortIngredientsByType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateIngredientRecipe;
use App\Http\Requests\UpdateIngredientRecipe;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IngredientRecipeController extends Controller
{
    public function __construct(protected SortIngredientsByType $sortAction)
    {
    }

    public function create(Recipe $recipe): View
    {
        return view(
            'admin.recipe.ingredient.create',
            [
                'recipe' => $recipe,
                'units' => Unit::all(),
                'groups' => $this->sortAction->execute(Ingredient::with('type')->get()),
            ]
        );
    }

    public function edit(Recipe $recipe): View
    {
        return view(
            'admin.recipe.ingredient.edit',
            [
                'recipe' => $recipe,
                'groups' => $this->sortAction->execute($recipe->ingredients()->with('type')->get()),
                'units' => Unit::all(),
            ]
        );
    }

    public function update(Recipe $recipe, UpdateIngredientRecipe $request): RedirectResponse
    {
        // $payload = [];
        dd($request->all());

        $payload = collect($request->validated('quantity'))
            ->map(
                function (float $quantity, int $ingredient_id) use ($request, $recipe, &$payload): array {

                    return [
                        'recipe_id' => $recipe->id,
                        'quantity' => $quantity,
                        'unit_id'  => (int) $request->validated('unit')[$ingredient_id],
                    ];
                }
            );

        // dd($payload);
        $recipe->ingredients()->sync($payload);

        return redirect()
            ->route('admin.recipe.get', $recipe)
            ->with('success', "stored {$recipe->ingredients()->count()} ingredients for recipe: {$recipe->name}");
    }

    public function store(Recipe $recipe, CreateIngredientRecipe $request): RedirectResponse
    {
        $recipe->ingredients()->attach($request->validated()['ingredient']);

        return redirect()
            ->route('admin.recipe.ingredient.edit', $recipe)
            ->with(
                'success',
                "stored {$recipe->ingredients()->count()} ingredients for recipe: {$recipe->name}"
            );
    }
}
