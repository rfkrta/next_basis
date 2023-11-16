<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(Request $request)

    {
        // Fetch all users
        $users = User::all();
        // Filter User
        $filter = $request->input('filter');

        if ($filter === 'active') {
            $users = User::where('status', 'active')->get();
        } elseif ($filter === 'inactive') {
            $users = User::where('status', 'inactive')->get();
        } else {
            $users = User::all();
        }

        // Pass the user data to the view
        return view('admin.user.index', compact('users', 'filter'));
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            // Add other fields and validation rules as needed
        ]);

        // Create a new user using Eloquent ORM
        $user = User::create($validatedData);

        // Redirect the user after successful creation
        return redirect()->route('admin.user.create')->with('success', 'User created successfully!');
    }
}
