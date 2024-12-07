<?php

namespace App\Http\Controllers;

use App\Models\Publicacio;
use Illuminate\Http\Request;

class PublicacioController extends Controller
{
    // Mostrar la llista de publicacions
    public function index()
    {
        $publicacions = Publicacio::all();
        return view('publicacions.index', compact('publicacions'));
    }

    // Mostrar el formulari per crear una nova publicació
    public function create()
    {
        $usuaris = \App\Models\Usuari::all();
        return view('publicacions.create', compact('usuaris'));
    }

    // Guardar una nova publicació
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titol' => 'required|string|max:100',
            'contingut' => 'required|string',
            'id_usuari' => 'required|exists:usuaris,id',
            // 'imatge' => 'nullable|string',
            'estat' => 'required|in:activa,inactiva',
            // 'publicacio_data' =>'required|date',
            //  'data_publicacio' => 'required|date',
        ]);

        Publicacio::create($validated);

        return redirect()->route('publicacions.index')->with('success', 'La publicació s\'ha creat correctament!');
    }

    // Enviar datos a Front
    public function sendDate()
    {
        $publicacio = Publicacio::all();

        return response()->json(['status' => 'success', 'data' => $publicacio]);
    }

    // Mostrar una publicació específica
    public function show($id)
    {
        $publicacio = Publicacio::findOrFail($id);
        return view('publicacions.show', compact('publicacio'));
    }

    // Mostrar el formulari per editar una publicació
    public function edit($id)
    {
        $publicacio = Publicacio::findOrFail($id);
        return view('publicacions.edit', compact('publicacio'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titol' => 'required|string|max:100',
            'contingut' => 'required|string',
            'estat' => 'required|in:activa,inactiva',
        ]);

        $publicacio = Publicacio::findOrFail($id);
        $publicacio->update($validated);

        return redirect()->route('publicacions.index')->with('success', 'La publicació s\'ha actualitzat correctament!');
    }



    // // Actualitzar una publicació existent
    // public function update(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'usuari_id' => 'required|exists:usuaris,id',
    //         'titol' => 'required|string|max:100',
    //         'contingut' => 'required|string',
    //         // 'imatge' => 'nullable|string',
    //         'estat' => 'required|in:activa,inactiva',
    //         'data_publicacio' => 'required|date',
    //     ]);

    //     $publicacio = Publicacio::findOrFail($id);
    //     $publicacio->update($validated);

    //     return redirect()->route('publicacions.index')->with('success', 'La publicació s\'ha actualitzat correctament!');
    // }

    // Eliminar una publicació
    public function destroy($id)
    {
        $publicacio = Publicacio::findOrFail($id);
        $publicacio->delete();

        return redirect()->route('publicacions.index')->with('success', 'La publicació s\'ha eliminat correctament!');
    }
}
