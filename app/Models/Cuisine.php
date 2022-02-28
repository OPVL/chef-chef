<?php

namespace App\Models;

use App\Models\Scopes\Alphabetical;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new Alphabetical);
    }
}
