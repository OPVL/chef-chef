<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterUser extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user() === null;
    }

    public function rules(): array
    {
        return [
            // 'username' => 'required|string|max:15|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ];
    }
}
