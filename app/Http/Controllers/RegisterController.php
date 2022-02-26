<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUser;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create(): View|RedirectResponse
    {
        return view('auth.register');
    }

    public function store(RegisterUser $request): RedirectResponse
    {
        $user = User::register($request->validated());
        Auth::login($user);
        return redirect()->intended('');
    }
}
