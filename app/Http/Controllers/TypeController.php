<?php

namespace App\Http\Controllers;

use App\Actions\DeleteType as DeleteAction;
use App\Http\Requests\CreateType;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateType;
use App\Models\Type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TypeController extends Controller
{
    public function __construct(protected DeleteAction $delete)
    {
    }

    public function index(): View
    {
        return view('type.index', ['types' => Type::all()]);
    }

    public function create(): View
    {
        return view('type.create');
    }

    public function get(Type $type): View
    {
        return view('type.get', ['type' => $type]);
    }

    public function edit(Type $type): View
    {
        return view('type.edit', ['type' => $type]);
    }

    public function update(Type $type, UpdateType $request): RedirectResponse
    {
        $type->update($request->validated());

        return redirect()
            ->route('type.index')
            ->with('success', "updated storage location: {$type->id}");
    }

    public function store(CreateType $request): RedirectResponse
    {
        $type = Type::create($request->validated());

        if ($type->exists()) {
            return redirect()
                ->route('type.index')
                ->with('success', "created storage location: {$type->id}");
        }

        return back()
            ->with('errors', 'unable to create storage location');
    }

    public function delete(Type $type, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()['confirm'] === "true") {
            $this->delete->execute($type);
        }

        return back();
    }
}
