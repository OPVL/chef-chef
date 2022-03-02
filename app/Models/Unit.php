<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'measurable',
        'should_space',
    ];

    protected $casts = [
        'measurable' => 'boolean',
        'should_space' => 'boolean',
    ];
}
