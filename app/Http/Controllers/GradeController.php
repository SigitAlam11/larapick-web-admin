<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all grades
        $grades = Grade::all();

        // return the view with the grades
        return view('pages.grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return the view for creating a grade
        return view('pages.grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:grades,name',
        ]);

        // create a new grade
        Grade::create([
            'name' => $request->name,
        ]);

        // return back with a success message
        return redirect()->route('grades.index')->with(['alert-type' => 'success', 'message' => 'Grade created successfully!']);
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
        // get the grade
        $grade = Grade::findOrFail($id);

        // return the view with the grade
        return view('pages.grades.edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:grades,name,' . $id,
        ]);

        // get the grade
        $grade = Grade::findOrFail($id);

        // update the grade
        $grade->update([
            'name' => $request->name,
        ]);

        // return back with a success message
        return redirect()->route('grades.index')->with(['alert-type' => 'success', 'message' => 'Grade updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // get the grade
        $grade = Grade::findOrFail($id);

        // delete the grade
        $grade->delete();

        // return back with a success message
        return redirect()->route('grades.index')->with(['alert-type' => 'success', 'message' => 'Grade deleted successfully!']);
    }
}
