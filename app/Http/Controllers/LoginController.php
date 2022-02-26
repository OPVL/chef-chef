<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function store(LoginUser $request): RedirectResponse
    {
        Auth::attempt(
            Arr::only($request->validated(), ['email', 'password']),
            Arr::get($request, 'remember', false)
        );

        return redirect()->intended('/');
    }

    public function delete(): RedirectResponse
    {
        Auth::logout();

        return redirect('/');
    }
}
