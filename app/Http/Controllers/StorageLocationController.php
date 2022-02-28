<?php

namespace App\Http\Controllers;

use App\Actions\DeleteStorageLocation as DeleteAction;
use App\Http\Requests\CreateStorageLocation;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateStorageLocation;
use App\Models\Cuisine;
use App\Models\StorageLocation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StorageLocationController extends Controller
{
    public function __construct(protected DeleteAction $delete)
    {
    }

    public function index(): View
    {
        return view('storage-location.index', ['storageLocations' => StorageLocation::all()]);
    }

    public function create(): View
    {
        return view('storage-location.create');
    }

    public function get(StorageLocation $storageLocation): View
    {
        return view('storage-location.get', ['storageLocation' => $storageLocation]);
    }

    public function edit(StorageLocation $storageLocation): View
    {
        return view('storage-location.edit', ['storageLocation' => $storageLocation]);
    }

    public function update(StorageLocation $storageLocation, UpdateStorageLocation $request): RedirectResponse
    {
        $storageLocation->update($request->validated());

        return redirect()
            ->route('storage-location.index')
            ->with('success', "updated storage location: {$storageLocation->id}");
    }

    public function store(CreateStorageLocation $request): RedirectResponse
    {
        $storageLocation = StorageLocation::create($request->validated());

        if ($storageLocation->exists()) {
            return redirect()
                ->route('storage-location.index')
                ->with('success', "created storage location: {$storageLocation->id}");
        }

        return back()
            ->with('errors', 'unable to create storage location');
    }

    public function delete(StorageLocation $storageLocation, DeleteRequest $request): RedirectResponse
    {
        if ($request->validated()['confirm'] === "true") {
            $this->delete->execute($storageLocation);
        }

        return back();
    }
}
