<?php

namespace App\Models;

use App\Models\Scopes\Alphabetical;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope(new Alphabetical);
    }
}
