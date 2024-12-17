<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendMail;
use App\Models\Alumne;
use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar les dades d'inici de sessió
        $validated = $request->validate([
            'correu' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Buscar l'usuari pel correu
        $usuari = Usuari::where('correu', $validated['correu'])->first();

        // Comprovar si l'usuari existeix i si la contrasenya és correcta
        if (!$usuari || !Hash::check($validated['password'], $usuari->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dades incorrectes',
            ], 401);
        }

        // Generar un token d'autenticació (Sanctum o personalitzat)
        $token = $usuari->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Inici de sessió correcte',
            'token' => $token,
            'usuari' => $usuari,
        ]);
    }
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'password' => 'required|string|min:6',
            'correu' => 'required|email|unique:usuaris,correu',
            'correualternatiu' => 'required|email|unique:usuaris,correualternatiu',
            'pregunta_secreta' => 'nullable|string',
            'resposta_secreta' => 'nullable|string',
        ]);

        // Crear el usuario en la base de datos
        try {
            $usuari = Usuari::create([
                'password' => bcrypt($request['password']),
                'correu' => $request['correu'],
                'correualternatiu' => $request['correualternatiu'],
                'pregunta_secreta' => $request['pregunta_secreta'] ?? null,
                'resposta_secreta' =>  $request['resposta_secreta'] ?? null,
            ]);


            // Enviar correo electrónico
            try {
                Mail::to($usuari->correu)->send(new SendMail($usuari->nom));
            } catch (\Exception $mailError) {
                Log::error('Mail sending failed: ' . $mailError->getMessage());
                Log::error('Mail sending trace: ' . $mailError->getTraceAsString());
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Usuari creat correctament!',
                'usuari' => $usuari
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    // Enviar datos a Front en formato JSON
    public function sendDataUsers()
    {
        $usuaris = Usuari::all();
        return response()->json(['status' => 'success', 'data' => $usuaris]);
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
            'correualternatiu' => 'required|correu|unique:usuaris,correualternatiu',
            'pregunta_secreta' => 'required|in: Quin és el nom del teu primer amic?,On vas fer la ESO?,Quin és el teu cotxe preferit?',
            'resposta_secreta' => 'required|string',
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
