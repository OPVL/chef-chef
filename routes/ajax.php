<?php

use Illuminate\Support\Facades\Route;

Route::get('ingredient')->uses('IngredientController')->name('ajax.ingredient');
Route::get('test')->uses('TestController')->name('ajax.test');
