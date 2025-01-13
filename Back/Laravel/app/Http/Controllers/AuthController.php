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
    // AuthController.php
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
            'usuari' => [
                'id' => $usuari->id,
                'rol' => $usuari->rol,
                'correu' => $usuari->correu
            ],
            'rol' => $usuari->rol, // enviar el rol també
        ]);
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'password' => 'required|string|min:6',
            'correu' => 'required|email|unique:usuaris,correu',
            'correualternatiu' => 'required|email|unique:usuaris,correualternatiu',
            'rol' => 'required|in:alumne,mentor,professor',
            'pregunta_secreta' => 'nullable|string',
            'resposta_secreta' => 'nullable|string',
        ]);

        // Crear el usuario en la base de datos
        try {
            $usuari = Usuari::create([
                'password' => Hash::make($request->password),
                'correu' => $request['correu'],
                'correualternatiu' => $request['correualternatiu'],
                'rol' => $request['rol'],
                'pregunta_secreta' => $request['pregunta_secreta'],
                'resposta_secreta' =>  $request['resposta_secreta'],
            ]);


            // Enviar correo electrónico
            try {
                Mail::to($usuari->correu)->send(new SendMail($usuari->nom));
            } catch (\Exception $mailError) {
                Log::error('Mail sending failed: ' . $mailError->getMessage());
                Log::error('Mail sending trace: ' . $mailError->getTraceAsString());
            }

            return redirect()->route('users.index')->with('success', 'Usuari creat correctament!');
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
            'password' => 'nullable|string|min:6',
            'rol' => 'required|in:alumne,mentor,professor',
            'correu' => 'required|email|unique:usuaris,correu,'.$id,
            'correualternatiu' => 'required|email|unique:usuaris,correualternatiu,'.$id,
            'pregunta_secreta' => 'required|in:Quin és nom del teu primer amic?,On vas fer la ESO?,Quin és el teu cotxe preferit?',
            'resposta_secreta' => 'required|string',
        ]);

        $usuari = Usuari::findOrFail($id);

        // Encriptar contraseña solo si se proporciona una nueva
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        // Actualizar usuario
        $usuari->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'Usuari actualitzat correctament!');
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
