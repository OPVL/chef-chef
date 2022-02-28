<?php

namespace App\Models;

use App\Models\Scopes\Alphabetical;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit_id',
        'storage_location_id',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new Alphabetical);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function storageLocation(): BelongsTo
    {
        return $this->belongsTo(StorageLocation::class);
    }
}
