<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show(string $id)
    {
        $student = Student::with('users')->where('qr_code', $id)->first();

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found',
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully fetched child data',
            'data' => StudentResource::make($student),
        ], 200);
    }
}
