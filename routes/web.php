<?php

use App\Http\Controllers\RecipeController;
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

Route::group(['prefix' => 'recipe'], function (): void {
    Route::get('/')->uses([RecipeController::class, 'get'])->name('recipe.index');
    Route::get('{recipe}')->uses('RecipeController@get')->name('recipe.get');
    Route::get('create')->uses('RecipeController@create')->name('recipe.create');
    Route::delete('delete')->uses('RecipeController@delete')->name('recipe.delete');
    Route::patch('update')->uses('RecipeController@update')->name('recipe.update');
    Route::put('store')->uses('RecipeController@store')->name('recipe.store');
});
