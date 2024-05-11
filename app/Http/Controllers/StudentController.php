<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all students sorted by the latest
        $students = Student::latest()->get();

        return view('pages.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get all grades
        $grades = Grade::all();

        // return the view for creating a student
        return view('pages.students.create', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'name' => 'required|string|max:255',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|string',
            'phone' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // upload the image when it is available
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/students', $imageName);
        }

        // if image is not available or null
        if (!isset($imageName)) {
            $imageName = null;
        }

        // create a new student
        Student::create([
            'grade_id' => $request->grade_id,
            'name' => $request->name,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $imageName,
            'qr_code' => Str::random(20),
        ]);

        // redirect to the students index
        return redirect()->route('students.index')->with(['alert-type' => 'success', 'message' => 'Student created successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get the student by id
        $student = Student::findOrFail($id);

        // get all grades
        $grades = Grade::all();

        // return the view for editing a student
        return view('pages.students.edit', compact('student', 'grades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the request
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'status' => 'required|in:active,inactive',
            'name' => 'required|string|max:255',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'address' => 'required|string',
            'phone' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // get the student by id
        $student = Student::findOrFail($id);

        // upload the image when it is available
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/students', $imageName);

            // delete the old image
            if ($student->image) {
                Storage::delete('public/students/' . $student->image);
            }
        }

        // if image is not available or null
        if (!isset($imageName)) {
            $imageName = $student->image;
        }

        // update the student
        $student->update([
            'grade_id' => $request->grade_id,
            'status' => $request->status,
            'name' => $request->name,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $imageName,
        ]);

        // redirect to the students index
        return redirect()->route('students.index')->with(['alert-type' => 'success', 'message' => 'Student updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // get the student by id
        $student = Student::findOrFail($id);

        // delete the student image
        if ($student->image) {
            Storage::delete('public/students/' . $student->image);
        }

        // delete the student
        $student->delete();

        // redirect to the students index
        return redirect()->route('students.index')->with(['alert-type' => 'success', 'message' => 'Student deleted successfully!']);
    }
}
