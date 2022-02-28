<?php

namespace App\Http\Controllers;

use App\Actions\CreateRecipe as CreateAction;
use App\Http\Requests\CreateRecipe;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateRecipe;
use App\Models\Cuisine;
use App\Models\Recipe;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RecipeController extends Controller
{
    public function __construct(protected CreateAction $create)
    {
    }

    public function index(): View
    {
        return view('recipe.index', ['recipes' => Recipe::all()]);
    }

    public function create(): View
    {
        $cuisines = Cuisine::all();

        return view('recipe.create', ['cuisines' => $cuisines]);
    }

    public function get(Recipe $recipe): View
    {
        return view('recipe.index', ['recipe' => $recipe]);
    }

    public function edit(Recipe $recipe): View
    {
        $cuisines = Cuisine::all();

        return view('recipe.edit', ['recipe' => $recipe, 'cuisines' => $cuisines]);
    }

    public function update(Recipe $recipe, UpdateRecipe $request): RedirectResponse
    {
        $recipe->update($request->validated());

        return redirect()
            ->route('recipe.index')
            ->with('success', "updated recipe: {$recipe->id}");
    }

    public function store(CreateRecipe $request): RedirectResponse
    {
        $recipe = $this->create->execute($request->validated());

        if ($recipe->exists() === false) {
            return back()
                ->with('errors', 'unable to create recipe');
        }

        return redirect()
            ->route('recipe.ingredient.create', $recipe)
            ->with('success', "created recipe: {$recipe->id}");
    }

    public function delete(Recipe $recipe, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()->confirm) {
            $recipe->delete();
        }

        return back();
    }
}
