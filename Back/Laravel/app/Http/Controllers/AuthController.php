<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'cognom1' => 'required|string|max:100',
            'cognom2' => 'required|string|max:100',
            'email' => 'required|email|unique:usuaris,email',
            'password' => 'required|string|min:6',
            'rol' => 'required|in:alumne,mentor,professor',
        ]);

        //encripta la contrasenya (OPCIONAL)
        //$validated['password'] = bcrypt($validated['password']);
        $usuari = Usuari::create($validated);

        return response()->json(['id' => $usuari->id], 201);
    }

    // CRUD de mostrar usuaris
    public function index()
    {
        $usuaris = Usuari::all();
        return response()->json($usuaris);
    }

    // CRUD de mostrar usuari por su id
    public function show($id)
    {
        $usuari = Usuari::findOrFail($id);
        return response()->json(($usuari));
    }

    // CRUD de actualitzar usuaris
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'cognom1' => 'required|string|max:100',
            'cognom2' => 'required|string|max:100',
            'email' => 'required|email|unique:usuaris,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
            'rol' => 'required|in:alumne,mentor,professor',
            'data_naixement' => 'required|date',
            'telefon' => 'required|string|max:9',
            'foto_profile' => 'nullable|string',
            'biografia' => 'nullable|string',
        ]);

        $usuari = Usuari::findOrFail($id);

        if ($request->has('password')) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $usuari->update($validated);

        return response()->json(['message' => 'Usuari actualitzat correctament.']);
    }


    // CRUD de eliminar usuaris
    public function destroy($id)
    {
        $usuari = Usuari::findOrFail($id);
        $usuari->destroy();

        return response()->json(['message' => 'Usuari eliminat correctament']);
    }


}
