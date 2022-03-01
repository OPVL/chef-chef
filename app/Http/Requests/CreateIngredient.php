<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateIngredient extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'unit_id' => 'nullable|integer|exists:units,id',
            'type_id' => 'nullable|integer|exists:types,id',
        ];
    }
}
