<?php

use App\Http\Controllers\CuisineController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WorkInProgressController;
use Illuminate\Support\Facades\Route;

Route::get('')->uses('AdminController@index')->name('admin.index');

Route::view(
    'test',
    'admin.ingredient.test'
);

Route::prefix('recipes')
    ->group(
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

Route::prefix('ingredients')
    ->group(
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

Route::prefix('units')
    ->group(
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

Route::prefix('cuisines')
    ->group(
        function (): void {
            Route::get('')->uses('CuisineController@index')->name('admin.cuisine.index');
            Route::get('create')->uses('CuisineController@create')->name('admin.cuisine.create');
            Route::get('{cuisine}')->uses('CuisineController@get')->name('admin.cuisine.get');
            Route::get('{cuisine}/edit')->uses('CuisineController@edit')->name('admin.cuisine.edit');
            Route::delete('{cuisine}/delete')->uses('CuisineController@delete')->name('admin.cuisine.delete');
            Route::patch('{cuisine}/update')->uses('CuisineController@update')->name('admin.cuisine.update');
            Route::put('store')->uses('CuisineController@store')->name('admin.cuisine.store');
        }
    );

Route::prefix('types')
    ->group(
        function (): void {
            Route::get('')->uses('TypeController@index')->name('admin.type.index');
            Route::get('create')->uses('TypeController@create')->name('admin.type.create');
            Route::get('{type}')->uses('TypeController@get')->name('admin.type.get');
            Route::get('{type}/edit')->uses('TypeController@edit')->name('admin.type.edit');
            Route::delete('{type}/delete')->uses('TypeController@delete')->name('admin.type.delete');
            Route::patch('{type}/update')->uses('TypeController@update')->name('admin.type.update');
            Route::put('store')->uses('TypeController@store')->name('admin.type.store');
        }
    );

Route::prefix('users')
    ->group(
        function (): void {
            Route::get('')->uses('WorkInProgressController')->name('admin.user.index');
            // Route::get('create')->uses('UserController@create')->name('admin.user.create');
            // Route::get('{user}')->uses('UserController@get')->name('admin.user.get');
            // Route::get('{user}/edit')->uses('UserController@edit')->name('admin.user.edit');
            // Route::delete('{user}/delete')->uses('UserController@delete')->name('admin.user.delete');
            // Route::patch('{user}/update')->uses('UserController@update')->name('admin.user.update');
            // Route::put('store')->uses('UserController@store')->name('admin.user.store');
        }
    );

Route::prefix('settings')
    ->group(
        function (): void {
            Route::get('')->uses('WorkInProgressController')->name('admin.setting.index');
            // Route::get('create')->uses('SettingController@create')->name('admin.setting.create');
            // Route::get('{setting}')->uses('SettingController@get')->name('admin.setting.get');
            // Route::get('{setting}/edit')->uses('SettingController@edit')->name('admin.setting.edit');
            // Route::delete('{setting}/delete')->uses('SettingController@delete')->name('admin.setting.delete');
            // Route::patch('{setting}/update')->uses('SettingController@update')->name('admin.setting.update');
            // Route::put('store')->uses('SettingController@store')->name('admin.setting.store');
        }
    );

Route::prefix('allergens')
    ->group(
        function (): void {
            Route::get('')->uses('AllergenController@index')->name('admin.allergen.index');
            Route::get('create')->uses('AllergenController@create')->name('admin.allergen.create');
            Route::get('{allergen}')->uses('AllergenController@get')->name('admin.allergen.get');
            Route::get('{allergen}/edit')->uses('AllergenController@edit')->name('admin.allergen.edit');
            Route::delete('{allergen}/delete')->uses('AllergenController@delete')->name('admin.allergen.delete');
            Route::patch('{allergen}/update')->uses('AllergenController@update')->name('admin.allergen.update');
            Route::put('store')->uses('AllergenController@store')->name('admin.allergen.store');
        }
    );
