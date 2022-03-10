<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class WorkInProgressController extends Controller
{
    public function __invoke(): View
    {
        return view('shared.under-construction');
    }
}
