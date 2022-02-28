<?php

namespace App\Actions;

use App\Models\Ingredient;
use App\Models\StorageLocation;

class DeleteStorageLocation implements Action
{
    public function execute(StorageLocation $storageLocation, bool $retry = false)
    {
        Ingredient::where('storage_location_id', $storageLocation->id)
            ->update(['storage_location_id' => $this->getDefaultStorageLocation()->id]);

        if ($storageLocation->ingredients->count() >= 1) {
            if ($retry === false) {
                return $this->execute($storageLocation, true);
            }

            return false;
        }

        return true;
    }

    protected function getDefaultStorageLocation(): StorageLocation
    {
        return StorageLocation::firstOrCreate(config('fallback.storage-location'));
    }
}
