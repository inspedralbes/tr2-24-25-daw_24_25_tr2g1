<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlumneController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\PublicacioController;


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

//ruta registre usuari
Route::post('/register', [AuthController::class, 'register']);
// ruta para CRUD
Route::get('/usuaris', [AuthController::class, 'index']);
Route::get('/usuaris/{id}', [AuthController::class, 'show']);
// Route::get('/users/{id}/edit', [AuthController::class, 'edit'])->name('users.edit');
Route::put('/usuaris/{id}', [AuthController::class, 'update'])->name('user-edit');
Route::delete('/usuaris/{id}', [AuthController::class, 'destroy'])->name('user-destroy');


// ruta de crud de publicaions
Route::get('/publicacions', [PublicacioController::class, 'index']);
Route::get('/publicacions/{id}', [PublicacioController::class, 'show']);
Route::post('/publicacions', [PublicacioController::class, 'store']);
Route::post('/sendDate', [PublicacioController::class, 'sendDate']);
Route::put('/publicacions/{id}', [PublicacioController::class, 'update']);
Route::delete('/publicacions/{id}', [PublicacioController::class, 'destroy']);


