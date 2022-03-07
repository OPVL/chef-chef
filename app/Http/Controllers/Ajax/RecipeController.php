<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecipeController extends AjaxController
{
    public function __invoke(Request $request): Response
    {
        return response(
            implode(
                '',
                Recipe::where('name', 'like', "%{$request->get('query')}%")
                    ->limit(5)
                    ->get()
                    ->map(function ($recipe) {
                        return $this->htmlElement(
                            'option',
                            $recipe->name,
                            ['value' => $recipe->id]
                        );
                    })->toArray()
            )
        );
    }
}
