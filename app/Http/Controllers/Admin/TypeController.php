<?php

namespace App\Http\Controllers\Admin;

use App\Actions\DeleteType as DeleteAction;
use App\Http\Controllers\Controller;
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
        return view('admin.type.index', ['types' => Type::all()]);
    }

    public function create(): View
    {
        return view('admin.type.create');
    }

    public function get(Type $type): View
    {
        return view('admin.type.view', ['type' => $type]);
    }

    public function edit(Type $type): View
    {
        return view('admin.type.edit', ['type' => $type]);
    }

    public function update(Type $type, UpdateType $request): RedirectResponse
    {
        $type->update($request->validated());

        return redirect()
            ->route('admin.type.index')
            ->with('success', "updated type: {$type->name}");
    }

    public function store(CreateType $request): RedirectResponse
    {
        $type = Type::create($request->validated());

        if ($type->exists()) {
            return redirect()
                ->route('admin.type.index')
                ->with('success', "created type: {$type->name}");
        }

        return back()
            ->with('errors', 'unable to create type');
    }

    public function delete(Type $type, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()['confirm'] === "true") {
            $this->delete->execute($type);
        }

        return redirect()
            ->route('admin.type.index')
            ->with('success', "deleted type: {$type->name}");
    }
}
