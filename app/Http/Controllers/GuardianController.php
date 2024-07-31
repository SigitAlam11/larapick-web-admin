<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all users sorted by the latest and get all users where is_admin = false
        $users = User::where('is_admin', false)->latest()->get();

        return view('pages.guardians.index', compact('users'));
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
            'id_number' => 'required|numeric|digits:16',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
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
            $image->storeAs('public/guardians', $imageName);
        }

        // if image is not available or null
        if (!isset($imageName)) {
            $imageName = null;
        }

        // create a new guard
        User::create([
            'student_id' => $request->student_id,
            'id_number' => $request->id_number,
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'relationship' => $request->relationship,
            'job' => $request->job,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $imageName,
            'password' => bcrypt($request->id_number),
            'qr_code' => Str::random(20),
        ]);

        // redirect to the guards index
        return redirect()->route('guardians.index')->with(['alert-type' => 'success', 'message' => 'Wali berhasil dibuat!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // get the user by id
        $guardian = User::findOrFail($id);

        // return the view for showing a guard
        return view('pages.guardians.show', compact('guardian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get the user by id
        $guardian = User::findOrFail($id);

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
        // Validate the request
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'id_number' => 'required|numeric|digits:16',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'gender' => 'required|in:male,female',
            'relationship' => 'required|string',
            'job' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Check if the email is already in use by another user
        $existingUser = User::where('email', $request->email)->where('id', '!=', $id)->first();
        if ($existingUser) {
            return redirect()->back()->withErrors(['email' => 'The email address is already in use by another user.'])->withInput();
        }

        // Get the guardian by id
        $guardian = User::findOrFail($id);

        // Upload the image if it is available
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->storeAs('public/guardians', $imageName);

            // Delete the old image
            if ($guardian->image) {
                Storage::delete('public/guardians/' . $guardian->image);
            }
        } else {
            // If image is not available or null, retain the old image name
            $imageName = $guardian->image;
        }

        // Update the guardian
        $guardian->update([
            'student_id' => $request->student_id,
            'id_number' => $request->id_number,
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'relationship' => $request->relationship,
            'job' => $request->job,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $imageName,
        ]);

        // Redirect to the guardians index
        return redirect()->route('guardians.index')->with(['alert-type' => 'success', 'message' => 'Wali berhasil diperbarui!']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // get the guard by id
        $guardian = User::findOrFail($id);

        // delete the guard image
        if ($guardian->image) {
            Storage::delete('public/guardians/' . $guardian->image);
        }

        // delete the guard
        $guardian->delete();

        // redirect to the guards index
        return redirect()->route('guardians.index')->with(['alert-type' => 'success', 'message' => 'Wali berhasil dihapus!']);
    }

    public function resetPassword(string $id)
    {
        // get the guard by id
        $guardian = User::findOrFail($id);

        // update the guard password
        $guardian->update([
            'password' => bcrypt($guardian->id_number),
        ]);

        // redirect to the guards index
        return redirect()->route('guardians.index')->with(['alert-type' => 'success', 'message' => 'Reset password berhasil!']);
    }
}
