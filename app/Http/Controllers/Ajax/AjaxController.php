<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    protected function htmlElement(string $name, string $value, array $attributes = []): string
    {
        $base = "<{$name}";

        collect($attributes)->map(function ($key, $value): void {
        });
    }
}
