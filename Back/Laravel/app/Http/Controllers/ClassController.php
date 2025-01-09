<?php

namespace App\Http\Controllers;

use App\Mail\ClassConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\Usuari;
use App\Models\Publicacio;

class ClassController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'classId' => 'required|exists:publicacions,id',
                'studentId' => 'required|exists:usuaris,id',
                'mentorId' => 'required|exists:usuaris,id'
            ]);

            // Get necessary data
            $classDetails = Publicacio::findOrFail($validated['classId']);
            $student = Usuari::findOrFail($validated['studentId']);
            $mentor = Usuari::findOrFail($validated['mentorId']);

            // Prepare class details for email
            $emailDetails = [
                'titol' => $classDetails->titol,
                'data_publicacio' => $classDetails->data_publicacio,
                'hora_inici' => $classDetails->hora_inici,
                'hora_final' => $classDetails->hora_final,
                'mentor_name' => $mentor->nom,
                'student_name' => $student->nom
            ];

            // Send email to student
            Mail::to($student->correu)->send(new ClassConfirmationMail($emailDetails));

            // Send email to mentor
            Mail::to($mentor->correu)->send(new ClassConfirmationMail($emailDetails));

            return response()->json([
                'success' => true,
                'message' => 'Inscripció realitzada correctament'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dades invalides: ' . $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error en el procés d\'inscripció: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error en el procés d\'inscripció: ' . $e->getMessage()
            ], 500);
        }
    }
}
