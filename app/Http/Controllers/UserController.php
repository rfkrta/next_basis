<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Regency;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)

    {
        $user_baru = User::join('positions', 'positions.id', '=', 'users.id_positions')
            ->select('users.*', 'positions.nama_posisi', 'positions.gaji_posisi')
            ->get();

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
        $roles = Role::all(); // Fetch all roles from the database
        return view('admin.user.create', compact('position', 'users', 'cities', 'roles'));
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
            'kota' => 'nullable|string',
            'id_positions' => 'required|integer',
            'role_id' => 'required|integer', // Validation for role_id
            'gaji_posisi' => 'required|string', // Validation for gaji_posisi
            'tanggal_mulai' => 'required|date', // Validation for tanggal_mulai
            'tanggal_selesai' => 'required|date|after:tanggal_mulai', // Validation for tanggal_selesai
        ]);

        // ... Existing validation and error handling logic

        // Create a new user instance
        $user = new User([
            // Assign other user details
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'nip' => $validatedData['nip'],
            'alamat' => $validatedData['alamat'],
            'no_hp' => $validatedData['no_hp'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'password' => bcrypt($validatedData['password']),
            'agama' => $validatedData['agama'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'kota' => $validatedData['kota'],
            'id_positions' => $validatedData['id_positions'],
            'role_id' => $validatedData['role_id'],
            'gaji_posisi' => $validatedData['gaji_posisi'], // Assign the gaji_posisi
            'tanggal_mulai' => $validatedData['tanggal_mulai'], // Assign the tanggal_mulai
            'tanggal_selesai' => $validatedData['tanggal_selesai'], // Assign the tanggal_selesai
        ]);

        // Save the user to the database
        $user->save();

        // Optionally, you can redirect somewhere after creating the user
        return redirect()->route('admin.user.index')->with('success', 'User created successfully');
    }



    public function getGajiPosisiById($id)
    {
        // Find the position by ID
        $position = Position::find($id);
        // Retrieve the gaji posisi value for the position
        $gajiPosisi = $position->gaji_posisi;
    }

    public function getRole($id)
    {
        // Find the role by ID
        $role = Role::find($id);

        // Check if the role exists
        if ($role) {
            // Retrieve the role name
            $roleName = $role->name;

            // Return the role name
            return $roleName;
        }
        // If role doesn't exist or ID is invalid, return null or handle accordingly
        return null; // or any other action based on your application logic
    }


    public function edit($id)
    {
        $item = User::findOrFail($id);
        $cities = Regency::orderBy('name', 'asc')->get();
        $positions = Position::all();
        $roles = Role::all(); // Fetch all roles from the database

        return view('admin.user.edit', compact('item', 'positions','roles', 'cities'));
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
            'kota' => 'required|string',
            'id_positions' => 'nullable|string',
            'gaji_posisi' => 'nullable|string',
            'role_id' => 'nullable|integer',
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
        $user->kota = $validatedData['kota'];   
        $user->id_positions = $validatedData['id_positions'];
        $user->gaji_posisi = $validatedData['gaji_posisi'];
        $user->role_id = $validatedData['role_id'];
        
        // Update other fields accordingly

        // Save the updated user data
        $user->save();

        // Optionally, you can redirect somewhere after updating the user
        return redirect()->route('admin.user.index')->with('success', 'User updated successfully');
    }
}
