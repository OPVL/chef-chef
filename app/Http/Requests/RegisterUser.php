<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUser extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:8|required|string',
            'repeat_password' => 'required|string|same:password',
        ];
    }

    public function messages()
    {
        return [
            'repeat_password.same' => 'your password must match, please try again',
        ];
    }
}
