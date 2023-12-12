<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all users
        $users = User::all();
        // Filter User
        $filter = $request->input('filter');
        if ($filter === 'Aktif') {
            $users = User::where('status', 'Aktif')->get();
        } elseif ($filter === 'Tidak Aktif') {
            $users = User::where('status', 'Tidak Aktif')->get();
        } // You might consider returning an error response for unrecognized filters in an API

        // Return the users data in JSON format
        return response()->json(['users' => $users, 'filter' => $filter]);
    }

    public function create()
    {
        $position = Position::all();
        $users = User::all();

        // Assuming this is for API, you might want to return data in JSON format
        return response()->json(['position' => $position, 'users' => $users]);
    }

    public function store(Request $request)
    {
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        // Add validation rules for other fields as needed
    ]);

    // Create a new user using the validated data
    $user = User::create($validatedData);

    // Return a success JSON response
    return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

}


