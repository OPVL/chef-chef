<?php

namespace Database\Seeders;

use App\Models\StorageLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StorageLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(config('defaults.storagelocations'))
            ->sort()
            ->each(function (string $storagelocation): void {
                StorageLocation::create(['name' => $storagelocation]);
            });
    }
}
