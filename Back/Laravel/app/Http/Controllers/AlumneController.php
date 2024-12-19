<?php

namespace App\Http\Controllers;

use App\Models\Alumne;
use Illuminate\Http\Request;

class AlumneController extends Controller
{
    public function store(Request $request)
    {
        // Validació de les dades
        $validated = $request->validate([
            'usuari_id' => 'required|exists:usuaris,id',
            'curs' => 'required|string|max:255',
        ]);

        // Crear l'alumne
        Alumne::create($validated);

        // Redirigir a una pàgina d'èxit o al panell d'usuari
        return redirect()->route('home')->with('success', 'Les dades d\'alumne s\'han guardat correctament!');
    }
}
