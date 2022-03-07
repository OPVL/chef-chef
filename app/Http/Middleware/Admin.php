<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        if (!Auth::user()->is_super) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
