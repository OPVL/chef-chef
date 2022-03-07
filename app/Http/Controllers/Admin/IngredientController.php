<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Actions\CreateIngredient as CreateAction;
use App\Http\Requests\CreateIngredient;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateIngredient;
use App\Models\Ingredient;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IngredientController extends Controller
{
    public function index(): View
    {
        return view(
            'admin.ingredient.index',
            [
                'ingredients' => Ingredient::with(['unit', 'type'])
                    ->get(),
            ]
        );
    }

    public function create(): View
    {
        $types = Type::all();
        $units = Unit::all();

        return view(
            'admin.ingredient.create',
            [
                'units' => $units,
                'types' => $types,
            ]
        );
    }

    public function get(Ingredient $ingredient): View
    {
        return view('admin.ingredient.index', ['ingredient' => $ingredient]);
    }

    public function edit(Ingredient $ingredient): View
    {
        $types = Type::all();
        $units = Unit::all();

        return view(
            'admin.ingredient.edit',
            [
                'ingredient' => $ingredient,
                'units' => $units,
                'types' => $types,
            ]
        );
    }

    public function update(Ingredient $ingredient, UpdateIngredient $request): RedirectResponse
    {
        $ingredient->update($request->validated());

        return redirect()
            ->route('ingredient.index')
            ->with('success', "updated ingredient: {$ingredient->id}");
    }

    public function store(CreateIngredient $request): RedirectResponse
    {
        $ingredient = Ingredient::create($request->validated());

        if ($ingredient->exists()) {
            return redirect()
                ->route('ingredient.index')
                ->with('success', "created ingredient: {$ingredient->id}");
        }

        return back()
            ->with('errors', 'unable to create ingredient');
    }

    public function delete(Ingredient $ingredient, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()['confirm'] === "true") {
            $ingredient->delete();
        }

        return back()->with('success', 'ingredient deleted');
    }
}