<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Resources\IngredientCollection;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientController extends AjaxController
{
    public function __invoke(Request $request): JsonResource
    {
        return new IngredientCollection(
            Ingredient::where('name', 'like', "%{$request->get('query')}%")
                ->limit(5)
                ->with(['type', 'unit'])
                ->get()
        );
    }
}
