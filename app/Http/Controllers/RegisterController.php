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
        $namePlaceholder = 'louis';
        $int = random_int(0, 98);
        dump($int);
        $number = $int < 13 ? '' : $int;

        return view('auth.register', [
            'emailPlaceholder' => "{$namePlaceholder}{$number}@example.com",
            'namePlaceholder' => $namePlaceholder,
            'passwordPlaceholder' => 'three-rough-boys',
        ]);
    }

    public function store(RegisterUser $request): RedirectResponse
    {
        $user = User::register($request->validated());
        Auth::login($user);
        return redirect()->intended('');
    }
}
