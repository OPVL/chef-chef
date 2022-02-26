<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::delete('logout')->uses([LoginController::class, 'delete'])->name('login.delete');

Route::group(['middleware' => 'guest'], function (): void {
    Route::get('login')->uses([LoginController::class, 'index'])->name('login');
    Route::put('login')->uses([LoginController::class, 'store'])->name('login.store');

    Route::get('register')->uses([RegisterController::class, 'create'])->name('register');
    Route::put('register')->uses([RegisterController::class, 'store'])->name('register.store');
});

Route::group(['prefix' => 'recipes'], function (): void {
    Route::get('')->uses([RecipeController::class, 'index'])->name('recipe.index');
    Route::get('create')->uses([RecipeController::class, 'create'])->name('recipe.create');
    Route::get('{recipe}')->uses([RecipeController::class, 'get'])->name('recipe.get');
    Route::delete('{recipe}/delete')->uses([RecipeController::class, 'delete'])->name('recipe.delete');
    Route::patch('{recipe}/update')->uses([RecipeController::class, 'update'])->name('recipe.update');
    Route::put('store')->uses([RecipeController::class, 'store'])->name('recipe.store');
});

Route::group(['prefix' => 'ingredients'], function (): void {
    Route::get('')->uses([IngredientController::class, 'index'])->name('ingredient.index');
    Route::get('create')->uses([IngredientController::class, 'create'])->name('ingredient.create');
    Route::get('{ingredient}')->uses([IngredientController::class, 'get'])->name('ingredient.get');
    Route::delete('{ingredient}/delete')->uses([IngredientController::class, 'delete'])->name('ingredient.delete');
    Route::patch('{ingredient}/update')->uses([IngredientController::class, 'update'])->name('ingredient.update');
    Route::put('store')->uses([IngredientController::class, 'store'])->name('ingredient.store');
});

Route::group(['prefix' => 'units'], function (): void {
    Route::get('')->uses([UnitController::class, 'index'])->name('unit.index');
    Route::get('create')->uses([UnitController::class, 'create'])->name('unit.create');
    Route::get('{unit}')->uses([UnitController::class, 'get'])->name('unit.get');
    Route::delete('{unit}/delete')->uses([UnitController::class, 'delete'])->name('unit.delete');
    Route::patch('{unit}/update')->uses([UnitController::class, 'update'])->name('unit.update');
    Route::put('store')->uses([UnitController::class, 'store'])->name('unit.store');
});
