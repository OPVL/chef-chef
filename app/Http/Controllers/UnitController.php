<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUnit;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateUnit;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UnitController extends Controller
{
    public function index(): View
    {
        return view('unit.index', ['units' => Unit::all()]);
    }

    public function create(): View
    {
        return view('unit.create');
    }

    public function get(Unit $unit): View
    {
        return view('unit.index', ['unit' => $unit]);
    }

    public function edit(Unit $unit): View
    {
        return view('unit.edit', ['unit' => $unit]);
    }

    public function update(Unit $unit, UpdateUnit $request): RedirectResponse
    {
        $unit->update($request->validated());

        return redirect()
            ->route('unit.index')
            ->with('success', "updated unit: {$unit->id}");
    }

    public function store(CreateUnit $request): RedirectResponse
    {
        $unit = Unit::create($request->validated());

        if ($unit->exists()) {
            return redirect()
                ->route('unit.index')
                ->with('success', "created unit: {$unit->id}");
        }

        return back()
            ->with('errors', 'unable to create unit');
    }

    public function delete(Unit $unit, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()->confirm) {
            $unit->delete();
        }

        return back();
    }
}
