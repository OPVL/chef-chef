<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    protected function htmlElement(string $name, string $innerValue, ?array $attributes = null): string
    {
        $base = "<{$name}";

        if ($attributes) {
            $attrList = implode(
                collect($attributes)
                    ->map(function ($key, $value): string {
                        if (!$value) {
                            return " $key";
                        }
                        return " {$key}=\"{$value}\"";
                    })->toArray()
            );
            $base .= $attrList . ">";
        } else {
            $base .= '>';
        }

        $base .= "{$innerValue}</{$name}>";

        return $base;
    }
}
