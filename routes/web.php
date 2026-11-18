<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetaniController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('petani', PetaniController::class);