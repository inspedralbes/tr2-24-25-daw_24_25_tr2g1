<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicacioController;
use Illuminate\Container\Attributes\Auth;

//pagina de benvinguda
Route::get('/', function () {
    return view('welcome');
});

//crud's
Route::resource('users', AuthController::class);
Route::resource('publicacions', PublicacioController::class);




