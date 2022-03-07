<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IngredientController extends AjaxController
{
    public function __invoke(Request $request): Response
    {
        return response(
            Ingredient::where('name', 'like', "%{$request->get('name')}")
                ->limit(5)
                ->get()
                ->map(function ($ingredient) {
                    return "<option value=\"{$ingredient->id}\">{$ingredient->name}</option>";
                })
        );
    }
}
