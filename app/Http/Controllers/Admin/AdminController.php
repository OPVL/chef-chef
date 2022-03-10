<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $pageTitle = 'Admin';
        $modules = [
            ['name' => 'recipes', 'icon' => '<i class="fa-solid fa-utensils"></i>', 'route' => route('admin.recipe.index')],
            ['name' => 'ingredients', 'icon' => '<i class="fa-solid fa-carrot"></i>', 'route' => route('admin.ingredient.index')],
            ['name' => 'units', 'icon' => '<i class="fa-solid fa-ruler"></i>', 'route' => route('admin.unit.index')],
            ['name' => 'cuisines', 'icon' => '<i class="fa-solid fa-earth-americas"></i>', 'route' => route('admin.cuisine.index')],
            ['name' => 'ingredient types', 'icon' => '<i class="fa-solid fa-table"></i>', 'route' => route('admin.type.index')],
            ['name' => 'users', 'icon' => '<i class="fa-solid fa-users"></i>', 'route' => route('admin.user.index')],
            ['name' => 'settings', 'icon' => '<i class="fa-solid fa-gear"></i>', 'route' => route('admin.setting.index')],
        ];

        return view('admin.dashboard', compact('pageTitle', 'modules'));
    }
}
