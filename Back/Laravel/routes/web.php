<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('home/', function () {
    return view('home');
});



Route::resource('users',    AuthController::class);

