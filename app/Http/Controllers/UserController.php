<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all users sorted by the latest
        $users = User::latest()->get();

        // return the view with the users
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return the view for creating a new user
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password')
        ]);

        // Redirect to the users index page
        return redirect()->route('users.index')->with(['alert-type' => 'success', 'message' => 'User created successfully!']);
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
        // Get the user by id
        $user = User::findOrFail($id);

        // Return the view for editing a user
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Get the user by id
        $user = User::findOrFail($id);

        // Update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Redirect to the users index page
        return redirect()->route('users.index')->with(['alert-type' => 'success', 'message' => 'User updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Get the user by id
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect to the users index page
        return redirect()->route('users.index')->with(['alert-type' => 'success', 'message' => 'User deleted successfully!']);
    }
}
