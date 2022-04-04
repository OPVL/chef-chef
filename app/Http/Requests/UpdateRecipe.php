<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipe extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'cuisine_id' => 'required|integer|exists:cuisines,id',
            'quantity' => 'nullable|array',
            'quantity.*' => 'numeric',
            'unit' => 'nullable|array',
            'unit.*' => 'exists:units,id|integer',
        ];
    }
}
