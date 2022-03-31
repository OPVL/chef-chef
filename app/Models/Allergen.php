<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergen extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'animal_product',
    ];

    protected $casts = [
        'animal_product' => 'bool',
    ];

    const FLESH = [
        'meat',
    ];

    const SEAFLESH = [
        'fish',
        'crustacean',
        'mollusc',
    ];

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }
}
