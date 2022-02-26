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

Route::get('login')->uses([LoginController::class, 'index'])->name('login.index');
Route::put('login')->uses([LoginController::class, 'store'])->name('login.store');
Route::put('logout')->uses([LoginController::class, 'delete'])->name('login.delete');

Route::get('register')->uses([RegisterController::class, 'create'])->name('register.create');
Route::put('register')->uses([RegisterController::class, 'store'])->name('register.store');

Route::group(['prefix' => 'recipe'], function (): void {
    Route::get('')->uses([RecipeController::class, 'index'])->name('recipe.index');
    Route::get('create')->uses([RecipeController::class, 'create'])->name('recipe.create');
    Route::get('{recipe}')->uses([RecipeController::class, 'get'])->name('recipe.get');
    Route::delete('delete')->uses([RecipeController::class, 'delete'])->name('recipe.delete');
    Route::patch('update')->uses([RecipeController::class, 'update'])->name('recipe.update');
    Route::put('store')->uses([RecipeController::class, 'store'])->name('recipe.store');
});
