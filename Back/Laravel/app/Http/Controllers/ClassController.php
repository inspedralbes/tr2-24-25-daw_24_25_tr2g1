<?php

namespace App\Http\Controllers;

use App\Mail\ClassConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Publicacio; 

class ClassController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'classId' => 'required',
                'studentId' => 'required',
                'mentorId' => 'required'
            ]);

            // Obtenir les dades necessàries
            $classDetails = Publicacio::find($request->classId);
            $student = User::find($request->studentId);
            $mentor = User::find($request->mentorId);

            if (!$classDetails || !$student || !$mentor) {
                return response()->json([
                    'success' => false,
                    'message' => 'No s\'han trobat totes les dades necessàries'
                ], 404);
            }

            // Here you would add your logic to save the registration in your database
            // ... codi per guardar la inscripció ...

            // Enviar email a l'alumne
            Mail::to($student->email)->send(
                new ClassConfirmationMail(
                    $student->name,
                    $mentor->name,
                    $classDetails,
                    false
                )
            );

            // Enviar email al mentor
            Mail::to($mentor->email)->send(
                new ClassConfirmationMail(
                    $student->name,
                    $mentor->name,
                    $classDetails,
                    true
                )
            );

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error en el procés d\'inscripció: ' . $e->getMessage()
            ], 500);
        }
    }
}
