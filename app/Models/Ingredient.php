<?php

namespace App\Models;

use App\Models\Scopes\Alphabetical;
use App\Models\Traits\HasAllergens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Pluralizer;
use Phospr\Fraction;

class Ingredient extends Model
{
    use HasFactory, HasAllergens;

    protected $fillable = [
        'name',
        'unit_id',
        'type_id',
    ];

    protected $with = [
        'allergens',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new Alphabetical);
    }

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class)
            ->using(IngredientRecipe::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    protected function getDisplayAttribute(): string
    {
        if (!$this->pivot || !$this->pivot->unit) {
            return "{$this->unit->name} of {$this->name}";
        }

        $quantity = $this->pivot->quantity >= 1
            ? (int) ($this->pivot->quantity ?? 0)
            : Fraction::fromFloat($this->pivot->quantity ?? 0);

        if ($this->pivot->unit->measurable ?? false) {
            $unit = $this->pivot->unit->label;
            $shouldSpace = $this->pivot->unit->should_space ? ' ' : '';

            return "{$quantity}{$shouldSpace}{$unit} of {$this->name}";
        }

        $ingredient = $this->pivot->quantity > 1 ? Pluralizer::plural($this->name) : $this->name;

        return "{$quantity} {$ingredient}";
    }

    protected function getContainsGlutenAttribute(): bool
    {
        return $this->allergens->filter(function (Allergen $allergen) {
            return $allergen->is_plant_based;
        })->count() > 0;
    }

    protected function getIsVeganAttribute(): bool
    {
        return $this->animal_product === false;
    }
}
