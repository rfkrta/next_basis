<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Regency;
use Illuminate\Support\Facades\DB;

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
        $cities = Regency::orderBy('name', 'asc')->get();
        $users = User::all();
        return view('admin.user.create', compact('position', 'users','cities'));
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
            'agama' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
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
            'agama' => $validatedData['agama'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            // Assign the agama field
            // Assign other fields accordingly
        ]);
        // Optionally, you can redirect somewhere after creating the user
        return redirect()->route('admin.user.index')->with('success', 'User created successfully');
    }
    public function edit($id)
    {
        $item = User::findOrFail($id);
        $cities = Regency::orderBy('name', 'asc')->get();
        $position = Position::all();

        return view('admin.user.edit', [
            'item' => $item,
            'position' => $position,
            'cities' => $cities
        ]);
    }
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);


        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'nip' => 'required|min:5',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|min:11',
            'tanggal_lahir' => 'required|date',
            'agama' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
            // Add validation rules for other fields as necessary
        ]);

        // Check if the 'email' already exists in the database for other users
        $existingEmail = User::where('email', $validatedData['email'])->where('id', '!=', $id)->first();
        if ($existingEmail) {
            return redirect()->back()->withInput()->withErrors(['email' => 'The email has already been taken.']);
            // Redirect back to the form with an error message for 'email'
        }

        // Check if the 'no_hp' already exists in the database for other users
        $existingNoHp = User::where('no_hp', $validatedData['no_hp'])->where('id', '!=', $id)->first();
        if ($existingNoHp) {
            return redirect()->back()->withInput()->withErrors(['no_hp' => 'The phone number has already been taken.']);
            // Redirect back to the form with an error message for 'no_hp'
        }

        // Update the user data with the validated data
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->nip = $validatedData['nip'];
        $user->alamat = $validatedData['alamat'];
        $user->no_hp = $validatedData['no_hp'];
        $user->tanggal_lahir = $validatedData['tanggal_lahir'];
        $user->agama = $validatedData['agama'];
        $user->jenis_kelamin = $validatedData['jenis_kelamin'];
        // Update other fields accordingly

        // Save the updated user data
        $user->save();

        // Optionally, you can redirect somewhere after updating the user
        return redirect()->route('admin.user.index')->with('success', 'User updated successfully');
    }
}
