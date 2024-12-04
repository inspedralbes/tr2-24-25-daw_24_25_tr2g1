<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuari;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'cognom1' => 'required|string|max:100',
            'cognom2' => 'required|string|max:100',
            'email' => 'required|email|unique:usuaris,email',
            'password' => 'required|string|min:6',
            'rol' => 'required|in:alumne,mentor,professor',
            'data_naixement' => 'required|date',
            'telefon' => 'required|string|max:9',
            'biografia' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Procesamiento de la imagen
        if ($request->hasFile('image')) {
            // Generamos un nombre único para la imagen
            $imageName = time() . '.' . $request->image->extension();
            // Guardamos la imagen en el directorio 'public/images'
            $request->image->storeAs('public/images', $imageName);
        } else {
            $imageName = null;
        }

        // Crear el usuario en la base de datos
        $usuari = Usuari::create([
            'nom' => $validated['nom'],
            'cognom1' => $validated['cognom1'],
            'cognom2' => $validated['cognom2'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'rol' => $validated['rol'],
            'data_naixement' => $validated['data_naixement'],
            'telefon' => $validated['telefon'],
            'foto_profile' => $imageName,
            'biografia' => $validated['biografia'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuari creat correctament!');
    }

    // CRUD de mostrar usuaris
    public function index()
    {
        $usuaris = Usuari::all();
        return view('users.index', compact('usuaris'));
    }

    // CRUD de mostrar usuari por su id
    public function show($id)
    {
        $usuari = Usuari::findOrFail($id);
        return view('users.show', compact('usuari'));
    }


    //Metoso para mostrar el formulario de edicion de un usuario
    public function edit($id)
    {
        $usuari = Usuari::findOrFail($id);
        return view('users.edit', compact('usuari'));
    }

    // CRUD de actualizar usuaris
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'cognom1' => 'required|string|max:100',
            'cognom2' => 'required|string|max:100',
            'email' => 'required|email|unique:usuaris,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'rol' => 'required|in:alumne,mentor,professor',
            'data_naixement' => 'sometimes|date',
            'telefon' => 'sometimes|string|max:9',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'biografia' => 'nullable|string',
        ]);

        $usuari = Usuari::findOrFail($id);

        // Encriptar contraseña si se proporciona
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        // Procesar la imagen si se sube
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $validated['foto_profile'] = $imageName;
        }

        // Actualizar usuario
        $usuari->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuari actualitzat correctament!');
    }

    // CRUD de eliminar usuaris
    public function destroy($id)
    {
        $usuari = Usuari::findOrFail($id);
        $usuari->delete();

        return redirect()->route('users.index')->with('success', 'Usuari eliminat correctament!');
    }

    // Mostrar formulario para crear un nuevo usuario
    public function create()
    {
        return view('users.create');
    }
}
