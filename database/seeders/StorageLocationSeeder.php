<?php

namespace Database\Seeders;

use App\Models\StorageLocation;
use Illuminate\Database\Seeder;

class StorageLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(config('defaults.storagelocations'))
            ->sort()
            ->each(function (string $storagelocation): void {
                StorageLocation::create(['name' => $storagelocation]);
            });
    }
}
