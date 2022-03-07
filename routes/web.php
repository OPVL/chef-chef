<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyMealPlanController;
use App\Http\Controllers\MyRecipesController;
use App\Http\Controllers\MyShoppingList;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
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

Route::get(
    '/',
    function () {
        return view('welcome');
    }
)->name('home');
Route::delete('logout')->uses([LoginController::class, 'delete'])->name('login.delete');

Route::middleware('guest')
    ->group(
        function (): void {
            Route::get('login')->uses([LoginController::class, 'index'])->name('login');
            Route::put('login')->uses([LoginController::class, 'store'])->name('login.store');

            Route::get('register')->uses([RegisterController::class, 'create'])->name('register');
            Route::put('register')->uses([RegisterController::class, 'store'])->name('register.store');
        }
    );

Route::prefix('my')
    ->middleware('auth')
    ->group(function (): void {
        Route::get('recipes')->uses([MyRecipesController::class, 'index'])->name('my.recipes.index');
        Route::get('meal-plan')->uses([MyMealPlanController::class, 'index'])->name('my.meal-plan.index');
        Route::get('shopping-list')->uses([MyShoppingList::class, 'index'])->name('my.shopping-list.index');
    });

Route::get('make-admin', function() {
    Auth::user()->update(['is_super' => true]);
})->middleware('auth');
