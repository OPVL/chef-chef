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
        $number = $int < 13 ? '' : $int;

        return view('auth.register', [
            'emailPlaceholder' => "{$namePlaceholder}{$number}@example.com",
            'namePlaceholder' => $namePlaceholder,
            'passwordPlaceholder' => 'three-rough-boys',
            'nonce' => config('app.debug') ? $this->seedDebugNonce($namePlaceholder, $number) : false,
        ]);
    }

    public function store(RegisterUser $request): RedirectResponse
    {
        $user = User::register($request->validated());
        Auth::login($user, true);

        if ($request->has('debug_nonce_make_admin') && $request->get('debug_nonce_make_admin') === session('debug_nonce')) {
            $user->is_super = true;
            $user->save();

            return redirect()->intended(route('admin.index'));
        }

        return redirect()->intended('');
    }
}
