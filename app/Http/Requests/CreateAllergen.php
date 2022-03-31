<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAllergen extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge(['animal_product' => (bool) $this->animal_product]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:allergens',
            'animal_product' => 'required|boolean',
        ];
    }
}
