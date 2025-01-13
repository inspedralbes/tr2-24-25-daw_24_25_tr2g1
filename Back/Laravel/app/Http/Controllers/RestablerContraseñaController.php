<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Models\Usuari;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RestablerContraseñaController extends Controller
{
    public function enviarCodigo(Request $request)
    {
        try {
            $request->validate([
                'correualternatiu' => 'required|email|exists:usuaris,correualternatiu',
            ]);

            // Verificar si el usuario existe
            $usuari = Usuari::where('correualternatiu', $request->correualternatiu)->first();
            if (!$usuari) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            $resetCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            Log::info('Reset Code Generated: ' . $resetCode . ' for email: ' . $request->correualternatiu);

            // primero intentar encontrar el registro
            $passwordReset = PasswordReset::where('email', $request->correualternatiu)->first();

            if ($passwordReset) {
                $passwordReset->token = $resetCode;
                $passwordReset->created_at = now();
                $passwordReset->save();
            } else {

                // actualizar codigo de reset
                PasswordReset::updateOrCreate(
                    ['email' => $request->correualternatiu],
                    [
                        'token' => $resetCode,
                        'created_at' => now()
                    ]
                );
            }
            // Enviar correo electronico
            Mail::send('emails.reset_code', ['code' => $resetCode], function ($message) use ($request) {
                $message->to($request->correualternatiu)->subject('Código de recuperacion de Contraseña');
            });

            return response()->json(['message' => 'codigo enviado correctamente']);
        } catch (\Exception $e) {
            Log::error('Error en enviarCodigo: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // funcion para verificar el codigo
    public function verifyResetCode(Request $request)
    {
        try {
            $request->validate([
                'correualternatiu' => 'required|email',
                'code' => 'required|size:6'
            ]);

            // Verificar si el usuario existe
            $usuari = Usuari::where('correualternatiu', $request->correualternatiu)->first();

            if (!$usuari) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            Log::info('Verificando código para: ' . $request->correualternatiu . ' Código: ' . $request->code);

            // verificar si el codigo es valido o no
            $resetRecord = PasswordReset::where('email', $request->correualternatiu)
                ->where('token', $request->code)
                ->where('created_at', '>', now()->subMinutes(30))
                ->first();

            if (!$resetRecord) {
                return response()->json(['error' => 'Codigo invalido'], 400);
            }

            return response()->json(['message' => 'Codigo valido']);
        } catch (\Exception $e) {
            Log::error('Error en verifyResetCode: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            // validar los datos
            $request->validate([
                'correualternatiu' => 'required|email',
                'password' => 'required|string|min:6',
                'code' => 'required|size:6'
            ]);

            // Verificar si el usuario existe
            $usuari = Usuari::where('correualternatiu', $request->correualternatiu)->first();

            if (!$usuari) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            // Verificar el código
            $resetRecord = PasswordReset::where('email', $request->correualternatiu)
                ->where('token', $request->code)
                ->first();

            if (!$resetRecord) {
                return response()->json(['error' => 'Código inválido'], 400);
            }

            // Actualizar contraseña
            $usuari->password = bcrypt($request->password);
            $usuari->save();

            // Eliminar registro de reset
            $resetRecord->delete();

            return response()->json(['message' => 'Contraseña actualizada correctamente']);
        } catch (\Exception $e) {
            Log::error('Error en resetPassword: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
