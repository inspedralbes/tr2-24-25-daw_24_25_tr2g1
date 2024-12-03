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
}
