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
            'storage_location_id' => 'nullable|integer|exists:storage_locations,id'
        ];
    }
}
