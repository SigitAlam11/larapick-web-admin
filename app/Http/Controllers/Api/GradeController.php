<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GradeResource;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    // get all grades
    public function index()
    {
        $grades = Grade::all();

        return response()->json([
            'status' => true,
            'message' => 'Successfully fetched grades',
            'data' => GradeResource::collection($grades),
        ], 200);
    }
}
