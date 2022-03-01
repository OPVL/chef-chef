<?php

namespace App\View\Components\Shared;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class Navigation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shared.navigation', ['showRegister' => Route::has('register')]);
    }
}
