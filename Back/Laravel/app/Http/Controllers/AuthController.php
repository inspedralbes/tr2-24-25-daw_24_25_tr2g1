<?php

namespace App\Http\Controllers;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación de la imagen
        ]);

        // Procesamiento de la imagen
        if ($request->hasFile('image')) {
            // Generamos un nombre único para la imagen
            $imageName = time().'.'.$request->image->extension();
            // Guardamos la imagen en el directorio 'public/images'
            $request->image->storeAs('public/images', $imageName);
        } else {
            $imageName = null; // Si no se sube imagen, dejamos el valor en null
        }

        // Crear el usuario en la base de datos
        $usuari = Usuari::create([
            'nom' => $validated['nom'],
            'cognom1' => $validated['cognom1'],
            'cognom2' => $validated['cognom2'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Encriptar la contraseña
            'rol' => $validated['rol'],
            'data_naixement' => $validated['data_naixement'],
            'telefon' => $validated['telefon'],
            'foto_profile' => $imageName, // Guardar el nombre de la imagen
            'biografia' => $validated['biografia'],
        ]);

        // Redirigir a la lista de usuarios con un mensaje de éxito
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

    // CRUD de actualizar usuaris
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'cognom1' => 'required|string|max:100',
            'cognom2' => 'required|string|max:100',
            'email' => 'required|email|unique:usuaris,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
            'rol' => 'required|in:alumne,mentor,professor',
            'data_naixement' => 'sometimes|date',
            'telefon' => 'sometimes|string|max:9',
            'foto_profile' => 'nullable|string',
            'biografia' => 'nullable|string',
        ]);

        $usuari = Usuari::findOrFail($id);

        if ($request->has('password')) {
            $validated['password'] = bcrypt($validated['password']);
        }

        // Actualización del usuario
        $usuari->update($validated);

        return response()->json(['message' => 'Usuari actualitzat correctament.']);
    }

    // CRUD de eliminar usuaris
    public function destroy($id)
    {
        $usuari = Usuari::findOrFail($id);
        $usuari->delete();

        return response()->json(['message' => 'Usuari eliminat correctament']);
    }

    // Mostrar formulario para crear un nuevo usuario
    public function create()
    {
        return view('users.create');  // Asegúrate de que la vista 'create' exista en resources/views/users
    }
}
