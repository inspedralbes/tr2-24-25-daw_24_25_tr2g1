<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;

class RolController extends Controller
{
    // Retorna tots els rols disponibles
    public function index()
    {
        return response()->json([
            'rols' => ['alumne', 'mentor', 'professor']
        ]);
    }

    // Assignar un rol a un usuari
    public function assign(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:usuaris,id',
            'rol' => 'required|in:alumne,mentor,professor',
        ]);

        $usuari = Usuari::find($request->user_id);
        $usuari->rol = $request->rol;
        $usuari->save();

        return response()->json([
            'success' => true,
            'message' => "Rol assignat a l'usuari correctament."
        ]);
    }
}
