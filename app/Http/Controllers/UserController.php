<?php

namespace App\Http\Controllers;

use App\Models\Position;
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
        if ($filter === 'Aktif') {
            $users = User::where('status', 'Aktif')->get();
        } elseif ($filter === 'Tidak Aktif') {
            $users = User::where('status', 'Tidak Aktif')->get();
        } else {
            $users = User::all();
        }
        // Pass the user data to the view
        return view('admin.user.index', compact('users', 'filter'));
    }
    public function create()
    {
        $position = Position::all();
        $users = User::all();
        return view('admin.user.create', compact('position', 'users'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nip' => 'required|min:5',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|min:11',
            'tanggal_lahir' => 'required|date',
            'agama' => 'nullable|string', // Validate the agama field
        ]);
        $existingNIP = User::where('nip', $validatedData['nip'])->first();
        if ($existingNIP) {
            return redirect()->back()->withInput()->withErrors(['nip' => 'The NIP has already been taken.']);
            // Redirect back to the form with an error message for 'nip'
        }

        // Check if the 'email' already exists in the database
        $existingEmail = User::where('email', $validatedData['email'])->first();
        if ($existingEmail) {
            return redirect()->back()->withInput()->withErrors(['email' => 'The email has already been taken.']);
            // Redirect back to the form with an error message for 'email'
        }

        // Check if the 'no_hp' already exists in the database
        $existingNoHp = User::where('no_hp', $validatedData['no_hp'])->first();
        if ($existingNoHp) {
            return redirect()->back()->withInput()->withErrors(['no_hp' => 'The phone number has already been taken.']);
            // Redirect back to the form with an error message for 'no_hp'
        }

        // Create a new user using the validated data
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'nip' => $validatedData['nip'],
            'alamat' => $validatedData['alamat'],
            'no_hp' => $validatedData['no_hp'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'password' => bcrypt($validatedData['password']),
            'agama' => $validatedData['agama'], // Assign the agama field
            // Assign other fields accordingly
        ]);
        // Optionally, you can redirect somewhere after creating the user
        return redirect()->route('admin.user.index')->with('success', 'User created successfully');
    }
}
