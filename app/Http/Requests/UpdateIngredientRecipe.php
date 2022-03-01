<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIngredientRecipe extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'unit' => 'required|array',
            'quantity' => 'required|array',
            'unit.*' => 'integer|exists:units,id',
            'quantity.*' => 'numeric|digits_between:0,999',
        ];
    }
}
