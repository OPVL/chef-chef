<?php

namespace App\Http\Controllers\Admin;

use App\Actions\CreateRecipe as CreateAction;
use App\Actions\SortIngredientsByType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRecipe;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateRecipe;
use App\Models\Cuisine;
use App\Models\Recipe;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RecipeController extends Controller
{
    public function __construct(protected CreateAction $create, protected SortIngredientsByType $sortIngredients)
    {
    }

    public function index(): View
    {
        return view('admin.recipe.index', ['recipes' => Recipe::all(), 'types' => Type::all()]);
    }

    public function create(): View
    {
        $cuisines = Cuisine::all();

        return view('admin.recipe.create', ['cuisines' => $cuisines]);
    }

    public function get(Recipe $recipe): View
    {
        return view('admin.recipe.view', ['recipe' => $recipe]);
    }

    public function edit(Recipe $recipe): View
    {
        $cuisines = Cuisine::all();
        $ingredients = $this->sortIngredients->execute($recipe->ingredients);
        $units = Unit::all();

        return view('admin.recipe.edit', ['recipe' => $recipe, 'cuisines' => $cuisines, 'groups' => $ingredients, 'units' => $units]);
    }

    public function update(Recipe $recipe, UpdateRecipe $request): RedirectResponse
    {
        $recipe->update($request->validated());

        return redirect()
            ->route('admin.recipe.index')
            ->with('success', "updated recipe: {$recipe->name}");
    }

    public function store(CreateRecipe $request): RedirectResponse
    {
        $recipe = $this->create->execute($request->validated());

        if ($recipe->exists() === false) {
            return back()
                ->with('errors', 'unable to create recipe');
        }

        return redirect()
            ->route('admin.recipe.ingredient.create', $recipe)
            ->with('success', "created recipe: {$recipe->name}");
    }

    public function delete(Recipe $recipe, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()['confirm'] === "true") {
            $recipe->delete();
        }

        return redirect()
            ->route('admin.recipe.index')
            ->with('success', "deleted recipe: {$recipe->name}");
    }
}
