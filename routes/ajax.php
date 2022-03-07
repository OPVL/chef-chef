<?php

use Illuminate\Support\Facades\Route;

Route::get('ingredient')->uses('IngredientController')->name('ajax.ingredient');
