<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function store(Request $request)
    {
        // Validació de les dades
        $validated = $request->validate([
            'usuari_id' => 'required|exists:usuaris,id',
            'departament' => 'required|string|max:255',
        ]);

        // Crear el professor
        Professor::create($validated);

        // Redirigir a una pàgina d'èxit o al panell d'usuari
        return redirect()->route('home')->with('success', 'Les dades del professor s\'han guardat correctament!');
    }
}
