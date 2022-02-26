<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class IngredientRecipe extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'ingredient_id',
        'quantity',
        'unit_id',
    ];

    /**
     * Get the recipe that owns the IngredientRecipe
     */
    public function recipe(): BelongsTo
    {
        // create some logic to set quanity & unit
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Get the ingredient that owns the IngredientRecipe
     */
    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }

    /**
     * Get the unit that owns the IngredientRecipe
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
