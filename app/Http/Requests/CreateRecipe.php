<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRecipe extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:6|max:36|string|unique:recipes,name',
            'description' => 'nullable|string|min:2',
            'cuisine_id' => 'required|integer|exists:cuisines,id',
        ];
    }
}
