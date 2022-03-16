<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAllergen;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateAllergen;
use App\Models\Allergen;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AllergenController extends Controller
{
    public function __construct()
    {
    }

    public function index(): View
    {
        return view('admin.allergen.index', ['allergens' => Allergen::all()]);
    }

    public function create(): View
    {
        return view('admin.allergen.create');
    }

    public function get(Allergen $allergen): View
    {
        return view('admin.allergen.view', ['allergen' => $allergen]);
    }

    public function edit(Allergen $allergen): View
    {
        return view('admin.allergen.edit', ['allergen' => $allergen]);
    }

    public function update(Allergen $allergen, UpdateAllergen $request): RedirectResponse
    {
        $allergen->update($request->validated());

        return redirect()
            ->route('admin.allergen.index')
            ->with('success', "updated allergen: {$allergen->name}");
    }

    public function store(CreateAllergen $request): RedirectResponse
    {
        $allergen = Allergen::create($request->validated());

        if ($allergen->exists()) {
            return redirect()
                ->route('admin.allergen.index')
                ->with('success', "created allergen: {$allergen->name}");
        }

        return back()
            ->with('errors', 'unable to create allergen');
    }

    public function delete(Allergen $allergen, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()['confirm'] === "true") {
            $this->delete->execute($allergen);
        }

        return redirect()
            ->route('admin.allergen.index')
            ->with('success', "deleted allergen: {$allergen->name}");
    }
}
