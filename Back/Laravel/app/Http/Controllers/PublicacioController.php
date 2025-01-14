<?php

namespace App\Http\Controllers;

use App\Models\Publicacio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
            'especialitat' => 'required|in:Matemáticas,Inglés,Ciencias,Biologia,Pogramacio,Geografia,Tecnologia,Quimica',
            'hora_inici' => 'nullable|string',
            'hora_final' => 'nullable|string',
            'dia' => 'nullable|in:Dilluns,Dimarts,Dimecres,Dijous,Divendres',
        ]);

        Publicacio::create($validated);

        return redirect()->route('publicacions.index')->with('success', 'La publicació s\'ha creat correctament!');
    }

    // Enviar datos a Front
    public function sendData()
    {
        $publicacio = Publicacio::all();
        return response()->json([
            'status' => 'success',
            'data' => $publicacio
        ]);
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
            'especialitat' => 'required|in:Matemáticas,Inglés,Ciencias,Biologia,Pogramacio,Geografia,Tecnologia,Quimica',
        ]);

        $publicacio = Publicacio::findOrFail($id);
        $publicacio->update($validated);

        return redirect()->route('publicacions.index')->with('success', 'La publicació s\'ha actualitzat correctament!');
    }

    // Eliminar una publicació
    public function destroy($id)
    {
        $publicacio = Publicacio::findOrFail($id);
        $publicacio->delete();

        return redirect()->route('publicacions.index')->with('success', 'La publicació s\'ha eliminat correctament!');
    }

    public function createOffer(Request $request)
    {

        //dd($request->all()); // Esto detendrá la ejecución y mostrará los datos enviados

        $validated = $request->validate([
            'id_usuari' => 'required|exists:usuaris,id',
            'titol' => 'required|string|max:100',
            'especialitat' => 'required|string|max:255',
            'contingut' => 'required|string',
            'dataPublicacion' => 'required|date',
            'horaInici' => 'required|string',
            'horaFinal' => 'required|string',
        ]);

        $publicacion = new Publicacio();

        $publicacion->id_usuari = $validated['id_usuari'];
        $publicacion->titol = $validated['titol'];
        $publicacion->especialitat = $validated['especialitat'];
        $publicacion->contingut = $validated['contingut'];
        $publicacion->data_publicacio = $validated['dataPublicacion'];
        $publicacion->hora_inici = $validated['horaInici'];
        $publicacion->hora_final = $validated['horaFinal'];

        $publicacion->save();


        //Publicacio::create($validated);

        return response()->json(['status' => 'success', 'message' => 'La oferta s\'ha creat correctament!']);
    }
}
