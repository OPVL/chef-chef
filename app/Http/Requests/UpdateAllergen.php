<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAllergen extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:36',
            'animal_product' => 'nullable|string',
        ];
    }
}
