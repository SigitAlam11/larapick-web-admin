<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // get all students by gradeId where status is active
    public function getStudentsByGrade(Request $request)
    {
        $students = Student::where('grade_id', $request->grade_id)
            ->where('status', 'active')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Successfully fetched students',
            'data' => StudentResource::collection($students),
        ], 200);
    }
}
