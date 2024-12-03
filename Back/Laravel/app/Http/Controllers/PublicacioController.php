<?php

namespace App\Http\Controllers;

use app\Models\Publicacio;
use Illuminate\Http\Request;

class PublicacioController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuari_id' => 'required|exists:usuaris,id',
            'titol' => 'required|string|max:100',
            'contingut' => 'required|string',
            'imatge' => 'nullable|string',
            'estat' => 'required|in:activa,inactiva',
            'data_publicacio' => 'required|date',

        ]);
        //creació de la publicació
        Publicacio::create($validated);

        return redirect()->route('home')->with('success', 'La publicació s\'ha guardat correctament!');
    }
}
