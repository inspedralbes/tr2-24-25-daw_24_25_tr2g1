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
            'classId' => 'required|exists:publicacions,id',
            'studentId' => 'required|exists:users,id',
            'mentorId' => 'required|exists:users,id'
        ]);

        // Get necessary data
        $classDetails = Publicacio::findOrFail($request->classId);
        $student = User::findOrFail($request->studentId);
        $mentor = User::findOrFail($request->mentorId);

        // Send email to student
        Mail::to($student->email)->send(
            new ClassConfirmationMail($classDetails)
        );

        // Send email to mentor
        Mail::to($mentor->email)->send(
            new ClassConfirmationMail($classDetails)
        );

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
        return response()->json([
            'success' => false,
            'message' => 'Error en el procés d\'inscripció: ' . $e->getMessage()
        ], 500);
    }
}
}
