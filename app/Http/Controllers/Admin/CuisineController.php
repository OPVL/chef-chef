<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCuisine;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateCuisine;
use App\Models\Cuisine;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CuisineController extends Controller
{
    public function index(): View
    {
        return view('admin.cuisine.index', ['cuisines' => Cuisine::all()]);
    }

    public function create(): View
    {
        return view('admin.cuisine.create');
    }

    public function get(Cuisine $cuisine): View
    {
        return view('admin.cuisine.index', ['cuisine' => $cuisine]);
    }

    public function update(Cuisine $cuisine, UpdateCuisine $request): RedirectResponse
    {
        $cuisine->update($request->validated());

        return redirect()
            ->route('admin.cuisine.index')
            ->with('success', "updated cuisine: {$cuisine->name}");
    }

    public function store(CreateCuisine $request): RedirectResponse
    {
        $cuisine = Cuisine::create($request->validated());

        if ($cuisine->exists()) {
            return redirect()
                ->route('admin.cuisine.index')
                ->with('success', "created cuisine: {$cuisine->name}");
        }

        return back()
            ->with('errors', 'unable to create cuisine');
    }

    public function delete(Cuisine $cuisine, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()['confirm'] === "true") {
            $cuisine->delete();
        }

        return redirect()
            ->route('admin.cuisine.index')
            ->with('success', "deleted cuisine: {$cuisine->name}");
    }
}
