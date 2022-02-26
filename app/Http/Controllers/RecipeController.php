<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecipe;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateRecipe;
use App\Models\Recipe;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RecipeController extends Controller
{
    public function index(): View
    {
        return view('recipe.index', ['recipes' => Recipe::all()]);
    }

    public function create(): View
    {
        return view('recipe.create');
    }

    public function get(Recipe $recipe): View
    {
        return view('recipe.index', ['recipe' => $recipe]);
    }

    public function update(Recipe $recipe, UpdateRecipe $request): RedirectResponse
    {
        $recipe->update($request->validated());

        return back();
    }

    public function store(CreateRecipe $request): RedirectResponse
    {
        Recipe::create($request->validated());

        return back();
    }

    public function delete(Recipe $recipe, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()->confirm) {
            $recipe->delete();
        }

        return back();
    }
}
