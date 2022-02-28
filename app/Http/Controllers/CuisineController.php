<?php

namespace App\Http\Controllers;

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
        return view('cuisine.index', ['cuisines' => Cuisine::all()]);
    }

    public function create(): View
    {
        return view('cuisine.create');
    }

    public function get(Cuisine $cuisine): View
    {
        return view('cuisine.index', ['cuisine' => $cuisine]);
    }

    public function update(Cuisine $cuisine, UpdateCuisine $request): RedirectResponse
    {
        $cuisine->update($request->validated());

        return back();
    }

    public function store(CreateCuisine $request): RedirectResponse
    {
        $cuisine = Cuisine::create($request->validated());

        if ($cuisine->exists()) {
            return redirect()
                ->route('cuisine.index')
                ->with('succss', "created cuisine: {$cuisine->id}");
        }

        return back()
            ->with('errors', 'unable to create cuisine');
    }

    public function delete(Cuisine $cuisine, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()->confirm) {
            $cuisine->delete();
        }

        return back();
    }
}
