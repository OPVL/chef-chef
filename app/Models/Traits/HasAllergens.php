<?php

namespace App\Models\Traits;

use App\Models\Allergen;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasAllergens
{
    public function allergens(): BelongsToMany
    {
        return $this->belongsToMany(Allergen::class);
    }

    protected function scopeGlutenFree(Builder $query): Builder
    {
        return $query->withoutAllergens(Allergen::firstWhere('name', 'like', '%gluten%'));
    }

    protected function scopeWithoutAllergens(Builder $query, Allergen ...$allergens): Builder
    {
        return $query->whereDoesntHave('allergens', function (Builder $query) use ($allergens) {
            return $query->whereIn('allergens.id', collect($allergens)->pluck('id'));
        });
    }

    protected function scopeWithAllergens(Builder $query, Allergen ...$allergens): Builder
    {
        return $query->whereHas('allergens', function (Builder $query) use ($allergens) {
            return $query->whereIn('allergens.id', collect($allergens)->pluck('id'));
        });
    }
}
