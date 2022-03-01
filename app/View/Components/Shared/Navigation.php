<?php

namespace App\View\Components\Shared;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Navigation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.shared.navigation', ['showRegister' => Route::has('register')]);
    }
}
