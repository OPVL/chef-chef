<?php

namespace App\Http\Controllers;

// use App\Actions\CreateIngredient as CreateAction;
use App\Http\Requests\CreateIngredient;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateIngredient;
use App\Models\Cuisine;
use App\Models\Ingredient;
use App\Models\StorageLocation;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IngredientController extends Controller
{
    // public function __construct(protected CreateAction $create)
    // {
    // }

    public function index(): View
    {
        return view(
            'ingredient.index',
            [
                'ingredients' => Ingredient::with(['unit', 'storageLocation'])
                    ->get()
            ]
        );
    }

    public function create(): View
    {
        $storageLocations = StorageLocation::all();
        $units = Unit::all();

        return view('ingredient.create', [
            'units' => $units,
            'storageLocations' => $storageLocations
        ]);
    }

    public function get(Ingredient $ingredient): View
    {
        return view('ingredient.index', ['ingredient' => $ingredient]);
    }

    public function edit(Ingredient $ingredient): View
    {
        $storageLocations = StorageLocation::all();
        $units = Unit::all();

        return view('ingredient.edit', [
            'ingredient' => $ingredient,
            'units' => $units,
            'storageLocations' => $storageLocations
        ]);
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
        if ($request->validated()->confirm) {
            $ingredient->delete();
        }

        return back();
    }
}
