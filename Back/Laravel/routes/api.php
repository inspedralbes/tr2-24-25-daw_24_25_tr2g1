<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AlumneController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProfessorController;


//ruta registre usuari
Route::post('/register', [AuthController::class, 'register']);

//ruta guardar segons el rol
Route::post('/alumnes', [AlumneController::class, 'storeAlumne']);
Route::post('/mentors', [MentorController::class, 'storeMentor']);
Route::post('/professors', [ProfessorController::class, 'storeProfessor']);

//rutes per gestionar els rols
Route::get('/rols', [RolController::class, 'index']);
Route::post('/rols/assign', [RolController::class, 'assign']);


//ruta per obtenir la informació del usuari autenticat
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
