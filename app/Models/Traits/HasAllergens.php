<?php

namespace App\Models\Traits;

use App\Models\Allergen;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasAllergens
{
    public function allergens(): BelongsToMany
    {
        return $this->belongsToMany(Allergen::class);
    }

    protected function getIsVeganAttribute(): bool
    {
        return $this->allergens()->where('is_animal_product', false)->count() > 0;
    }

    protected function getIsVegetarian(): bool
    {
        return $this->allergens()->where('is_animal_product', false)->count() > 0;
    }
}
