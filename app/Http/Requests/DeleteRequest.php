<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true || Auth::user()->is_super;
    }

    public function rules(): array
    {
        return [
            'confirm' => 'required|in:true,false',
        ];
    }
}
