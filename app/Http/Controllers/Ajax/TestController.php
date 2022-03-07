<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends AjaxController
{
    public function __invoke(Request $request): Response
    {
        $name = $request->get('query');
        $ingredients = Ingredient::where('name', 'like', "%{$name}%")
            ->limit(10)
            ->get();

        $mapped = $ingredients->map(function ($ingredient) {
            $id = $this->htmlElement('td', $ingredient->id);
            $name = $this->htmlElement('td', $ingredient->name);
            return $this->htmlElement('tr', $id . $name . $name . $name);
        });

        $imploded = implode('', $mapped->toArray());
        return Response($imploded);
    }
}
