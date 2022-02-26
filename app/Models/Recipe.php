<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Recipe extends Model
{
    use HasFactory;

    public function ingredients(): HasManyThrough
    {
        return $this->hasManyThrough(Ingredient::class, IngredientRecipe::class);
    }
}
