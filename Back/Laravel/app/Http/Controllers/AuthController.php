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
            'password' => 'required|string|min:6',
            'data_naixement' => 'required|date',
            'rol' => 'required|in:alumne,mentor,professor',
            'correu' => 'required|correu|unique:usuaris,correu',
            'correualternatiu'=> 'required|correu|unique:usuaris,correualternatiu',
            'pregunta_secreta' => 'required|in: Quin és el nom del teu primer amic?,On vas fer la ESO?,Quin és el teu cotxe preferit?',
            'resposta_secreta'=> 'required|string',
            'telefon' => 'required|string|max:9',
            'biografia' => 'nullable|string',
            'major' => 'required|in:si,no',
        ]);

       

        // Crear el usuario en la base de datos
        $usuari = Usuari::create([
            'nom' => $validated['nom'],
            'cognom1' => $validated['cognom1'],
            'cognom2' => $validated['cognom2'],
            'password' => bcrypt($validated['password']),
            'data_naixement' => $validated['data_naixement'],
            'rol' => $validated['rol'],
            'correu' => $validated['correu'],
            'correualternatiu'=> $validated['correualternatiu'],
            'pregunta_secreta'=> $validated['pregunta_secreta'],
            'resposta_secreta'=> $validated['resposta_secreta'],
            'telefon' => $validated['telefon'],
            'biografia' => $validated['biografia'],
            'major'=> $validated['major'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuari creat correctament!');
    }


    // Enviar datos a Front en formato JSON
    public function sendDataUsers()
    {
        $usuaris = Usuari::all();
        return response()->json(['status'=> 'success','data'=> $usuaris]);
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
            'password' => 'required|string|min:6',
            'data_naixement' => 'required|date',
            'rol' => 'required|in:alumne,mentor,professor',
            'correu' => 'required|correu|unique:usuaris,correu',
            'correualternatiu'=> 'required|correu|unique:usuaris,correualternatiu',
            'pregunta_secreta' => 'required|in: Quin és el nom del teu primer amic?,On vas fer la ESO?,Quin és el teu cotxe preferit?',
            'resposta_secreta'=> 'required|string',
            'telefon' => 'required|string|max:9',
            'biografia' => 'nullable|string',
            'major' => 'required|in:si,no',
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
