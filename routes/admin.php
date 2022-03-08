<?php

use App\Http\Controllers\CuisineController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('')->uses('AdminController@index')->name('admin.index');

Route::view(
    'test',
    'admin.ingredient.test'
);

Route::group(
    ['prefix' => 'recipes'],
    function (): void {
        Route::get('')->uses('RecipeController@index')->name('admin.recipe.index');
        Route::get('create')->uses('RecipeController@create')->name('admin.recipe.create');
        Route::get('{recipe}')->uses('RecipeController@get')->name('admin.recipe.get');
        Route::get('{recipe}/ingredients')->uses('IngredientRecipeController@create')->name('admin.recipe.ingredient.create');
        Route::get('{recipe}/ingredients/edit')->uses('IngredientRecipeController@edit')->name('admin.recipe.ingredient.edit');
        Route::patch('{recipe}/ingredients/update')->uses('IngredientRecipeController@update')->name('admin.recipe.ingredient.update');
        Route::put('{recipe}/ingredients')->uses('IngredientRecipeController@store')->name('admin.recipe.ingredient.store');
        Route::get('{recipe}/edit')->uses('RecipeController@edit')->name('admin.recipe.edit');
        Route::delete('{recipe}/delete')->uses('RecipeController@delete')->name('admin.recipe.delete');
        Route::patch('{recipe}/update')->uses('RecipeController@update')->name('admin.recipe.update');
        Route::put('store')->uses('RecipeController@store')->name('admin.recipe.store');
    }
);

Route::group(
    ['prefix' => 'ingredients'],
    function (): void {
        Route::get('')->uses('IngredientController@index')->name('admin.ingredient.index');
        Route::get('create')->uses('IngredientController@create')->name('admin.ingredient.create');
        Route::get('{ingredient}')->uses('IngredientController@get')->name('admin.ingredient.get');
        Route::get('{ingredient}/edit')->uses('IngredientController@edit')->name('admin.ingredient.edit');
        Route::delete('{ingredient}/delete')->uses('IngredientController@delete')->name('admin.ingredient.delete');
        Route::patch('{ingredient}/update')->uses('IngredientController@update')->name('admin.ingredient.update');
        Route::put('store')->uses('IngredientController@store')->name('admin.ingredient.store');
    }
);

Route::group(
    ['prefix' => 'units'],
    function (): void {
        Route::get('')->uses('UnitController@index')->name('admin.unit.index');
        Route::get('create')->uses('UnitController@create')->name('admin.unit.create');
        Route::get('{unit}')->uses('UnitController@get')->name('admin.unit.get');
        Route::get('{unit}/edit')->uses('UnitController@edit')->name('admin.unit.edit');
        Route::delete('{unit}/delete')->uses('UnitController@delete')->name('admin.unit.delete');
        Route::patch('{unit}/update')->uses('UnitController@update')->name('admin.unit.update');
        Route::put('store')->uses('UnitController@store')->name('admin.unit.store');
    }
);

Route::group(
    ['prefix' => 'cuisines'],
    function (): void {
        Route::get('')->uses([CuisineController::class, 'index'])->name('admin.cuisine.index');
        Route::get('create')->uses([CuisineController::class, 'create'])->name('admin.cuisine.create');
        Route::get('{cuisine}')->uses([CuisineController::class, 'get'])->name('admin.cuisine.get');
        Route::get('{cuisine}/edit')->uses([CuisineController::class, 'edit'])->name('admin.cuisine.edit');
        Route::delete('{cuisine}/delete')->uses([CuisineController::class, 'delete'])->name('admin.cuisine.delete');
        Route::patch('{cuisine}/update')->uses([CuisineController::class, 'update'])->name('admin.cuisine.update');
        Route::put('store')->uses([CuisineController::class, 'store'])->name('admin.cuisine.store');
    }
);

Route::group(
    ['prefix' => 'types'],
    function (): void {
        Route::get('')->uses([TypeController::class, 'index'])->name('admin.type.index');
        Route::get('create')->uses([TypeController::class, 'create'])->name('admin.type.create');
        Route::get('{type}')->uses([TypeController::class, 'get'])->name('admin.type.get');
        Route::get('{type}/edit')->uses([TypeController::class, 'edit'])->name('admin.type.edit');
        Route::delete('{type}/delete')->uses([TypeController::class, 'delete'])->name('admin.type.delete');
        Route::patch('{type}/update')->uses([TypeController::class, 'update'])->name('admin.type.update');
        Route::put('store')->uses([TypeController::class, 'store'])->name('admin.type.store');
    }
);
