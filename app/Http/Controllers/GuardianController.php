<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all guards sorted by the latest
        $guardians = Guardian::latest()->get();

        return view('pages.guardians.index', compact('guardians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get all students
        $students = Student::all();

        // return the view for creating a guard
        return view('pages.guardians.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'id_number' => 'required|numeric|unique:guardians,id_number|digits:16',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'relationship' => 'required|string',
            'job' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // upload the image when it is available
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/guards', $imageName);
        }

        // if image is not available or null
        if (!isset($imageName)) {
            $imageName = null;
        }

        // create a new guard
        Guardian::create([
            'student_id' => $request->student_id,
            'id_number' => $request->id_number,
            'name' => $request->name,
            'gender' => $request->gender,
            'relationship' => $request->relationship,
            'job' => $request->job,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $imageName,
            'password' => bcrypt($request->id_number),
        ]);

        // redirect to the guards index
        return redirect()->route('guardians.index')->with(['alert-type' => 'success', 'message' => 'Guardian created successfully!']);
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
        // get the guard by id
        $guardian = Guardian::findOrFail($id);

        // get all students
        $students = Student::all();

        // return the view for editing a guard
        return view('pages.guardians.edit', compact('guardian', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the request
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'id_number' => 'required|numeric|digits:16',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'relationship' => 'required|string',
            'job' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // get the guard by id
        $guardian = Guardian::findOrFail($id);

        // upload the image when it is available
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/guards', $imageName);

            // delete the old image
            if ($guardian->image) {
                Storage::delete('public/guardians/' . $guardian->image);
            }
        }

        // if image is not available or null
        if (!isset($imageName)) {
            $imageName = $guardian->image;
        }

        // update the guard
        $guardian->update([
            'student_id' => $request->student_id,
            'id_number' => $request->id_number,
            'name' => $request->name,
            'gender' => $request->gender,
            'relationship' => $request->relationship,
            'job' => $request->job,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $imageName,
            'password' => bcrypt($request->id_number),
        ]);

        // redirect to the guards index
        return redirect()->route('guardians.index')->with(['alert-type' => 'success', 'message' => 'Guardian updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // get the guard by id
        $guardian = Guardian::findOrFail($id);

        // delete the guard image
        if ($guardian->image) {
            Storage::delete('public/guardians/' . $guardian->image);
        }

        // delete the guard
        $guardian->delete();

        // redirect to the guards index
        return redirect()->route('guardians.index')->with(['alert-type' => 'success', 'message' => 'Guardian deleted successfully!']);
    }

    public function resetPassword(string $id)
    {
        // get the guard by id
        $guardian = Guardian::findOrFail($id);

        // update the guard password
        $guardian->update([
            'password' => bcrypt($guardian->id_number),
        ]);

        // redirect to the guards index
        return redirect()->route('guardians.index')->with(['alert-type' => 'success', 'message' => 'Guardian password reset successfully!']);
    }
}
