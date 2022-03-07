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
            implode(
                '',
                Ingredient::where('name', 'like', "%{$request->get('query')}%")
                    ->limit(5)
                    ->get()
                    ->map(function ($ingredient) {
                        return $this->htmlElement(
                            'option',
                            $ingredient->name,
                            ['value' => $ingredient->id]
                        );
                    })->toArray()
            )
        );
    }
}
