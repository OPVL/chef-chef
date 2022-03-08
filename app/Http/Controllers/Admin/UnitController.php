<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.unit.index', ['units' => Unit::all()]);
    }

    public function create(): View
    {
        return view('admin.unit.create');
    }

    public function get(Unit $unit): View
    {
        return view('admin.unit.index', ['unit' => $unit]);
    }

    public function edit(Unit $unit): View
    {
        return view('admin.unit.edit', ['unit' => $unit]);
    }

    public function update(Unit $unit, UpdateUnit $request): RedirectResponse
    {
        $unit->update($request->validated());

        return redirect()
            ->route('admin.unit.index')
            ->with('success', "updated unit: {$unit->id}");
    }

    public function store(CreateUnit $request): RedirectResponse
    {
        $unit = Unit::create($request->validated());

        if ($unit->exists()) {
            return redirect()
                ->route('admin.unit.index')
                ->with('success', "created unit: {$unit->name}");
        }

        return back()
            ->with('errors', 'unable to create unit');
    }

    public function delete(Unit $unit, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()['confirm'] === "true") {
            $unit->delete();
        }

        return redirect()
            ->route('admin.unit.index')
            ->with('success', "deleted unit: {$unit->name}");
    }
}
