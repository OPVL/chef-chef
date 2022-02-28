<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StorageLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get all of the ingredients for the StorageLocation
     */
    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }
}