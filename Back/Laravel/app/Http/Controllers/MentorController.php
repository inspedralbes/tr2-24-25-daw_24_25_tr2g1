<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function store(Request $request)
    {
        // Validació de les dades
        $validated = $request->validate([
            'usuari_id' => 'required|exists:usuaris,id',
            'especialitat' => 'required|string|max:255',
            'nom'=> 'required|string|max:255',
            'cognom'=> 'required|string|max:255',
            'correu'=> 'required|string',
            'curs'=> 'required|string|max:255',

        ]);

        // Crear el mentor
        Mentor::create($validated);

        // Redirigir a una pàgina d'èxit o al panell d'usuari
        return redirect()->route('home')->with('success', 'Les dades del mentor s\'han guardat correctament!');
    }
    public function sendDataMentors(){

        $mentor = Mentor::all();
        return response()->json(['status' => 'success', 'data' => $mentor]);
    }
}
