<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUser extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['remember' => (bool) $this->remember]);
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'nullable|boolean',
        ];
    }
}
