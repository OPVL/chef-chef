<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('')->uses('AdminController@index')->name('admin.index');

Route::group(
    ['prefix' => 'recipes'],
    function (): void {
        Route::get('')->uses('RecipeController@index')->name('recipe.index');
        Route::get('create')->uses('RecipeController@create')->name('recipe.create');
        Route::get('{recipe}')->uses('RecipeController@get')->name('recipe.get');
        Route::get('{recipe}/ingredients')->uses('IngredientRecipeController@create')->name('recipe.ingredient.create');
        Route::get('{recipe}/ingredients/edit')->uses('IngredientRecipeController@edit')->name('recipe.ingredient.edit');
        Route::patch('{recipe}/ingredients/update')->uses('IngredientRecipeController@update')->name('recipe.ingredient.update');
        Route::put('{recipe}/ingredients')->uses('IngredientRecipeController@store')->name('recipe.ingredient.store');
        Route::get('{recipe}/edit')->uses('RecipeController@edit')->name('recipe.edit');
        Route::delete('{recipe}/delete')->uses('RecipeController@delete')->name('recipe.delete');
        Route::patch('{recipe}/update')->uses('RecipeController@update')->name('recipe.update');
        Route::put('store')->uses('RecipeController@store')->name('recipe.store');
    }
);

Route::group(
    ['prefix' => 'ingredients'],
    function (): void {
        Route::get('')->uses([IngredientController::class, 'index'])->name('ingredient.index');
        Route::get('create')->uses([IngredientController::class, 'create'])->name('ingredient.create');
        Route::get('{ingredient}')->uses([IngredientController::class, 'get'])->name('ingredient.get');
        Route::get('{ingredient}/edit')->uses([IngredientController::class, 'edit'])->name('ingredient.edit');
        Route::delete('{ingredient}/delete')->uses([IngredientController::class, 'delete'])->name('ingredient.delete');
        Route::patch('{ingredient}/update')->uses([IngredientController::class, 'update'])->name('ingredient.update');
        Route::put('store')->uses([IngredientController::class, 'store'])->name('ingredient.store');
    }
);

Route::group(
    ['prefix' => 'units'],
    function (): void {
        Route::get('')->uses([UnitController::class, 'index'])->name('unit.index');
        Route::get('create')->uses([UnitController::class, 'create'])->name('unit.create');
        Route::get('{unit}')->uses([UnitController::class, 'get'])->name('unit.get');
        Route::get('{unit}/edit')->uses([UnitController::class, 'edit'])->name('unit.edit');
        Route::delete('{unit}/delete')->uses([UnitController::class, 'delete'])->name('unit.delete');
        Route::patch('{unit}/update')->uses([UnitController::class, 'update'])->name('unit.update');
        Route::put('store')->uses([UnitController::class, 'store'])->name('unit.store');
    }
);

Route::group(
    ['prefix' => 'cuisines'],
    function (): void {
        Route::get('')->uses([CuisineController::class, 'index'])->name('cuisine.index');
        Route::get('create')->uses([CuisineController::class, 'create'])->name('cuisine.create');
        Route::get('{cuisine}')->uses([CuisineController::class, 'get'])->name('cuisine.get');
        Route::get('{cuisine}/edit')->uses([CuisineController::class, 'edit'])->name('cuisine.edit');
        Route::delete('{cuisine}/delete')->uses([CuisineController::class, 'delete'])->name('cuisine.delete');
        Route::patch('{cuisine}/update')->uses([CuisineController::class, 'update'])->name('cuisine.update');
        Route::put('store')->uses([CuisineController::class, 'store'])->name('cuisine.store');
    }
);

Route::group(
    ['prefix' => 'types'],
    function (): void {
        Route::get('')->uses([TypeController::class, 'index'])->name('type.index');
        Route::get('create')->uses([TypeController::class, 'create'])->name('type.create');
        Route::get('{type}')->uses([TypeController::class, 'get'])->name('type.get');
        Route::get('{type}/edit')->uses([TypeController::class, 'edit'])->name('type.edit');
        Route::delete('{type}/delete')->uses([TypeController::class, 'delete'])->name('type.delete');
        Route::patch('{type}/update')->uses([TypeController::class, 'update'])->name('type.update');
        Route::put('store')->uses([TypeController::class, 'store'])->name('type.store');
    }
);
