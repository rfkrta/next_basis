<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
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

    public function showUsersWithRoleId(Request $request)
    {
        // Mengambil pengguna dengan role_id = 3
        $users = User::where('role_id', 3)->get();

        // Mendapatkan nama role dari tabel roles
        $roleName = Role::find(3)->name; // Ganti 3 dengan ID role yang sesuai

        // Menambahkan nama role pada setiap data pengguna
        foreach ($users as $user) {
            $user->role_name = $roleName;
        }

        // Mengembalikan data pengguna dalam format JSON
        return response()->json(['data' => $users]);
    }
    public function update(Request $request, $user_id)
    {
        try {
            // Validate the incoming request data for updating user
            $validatedData = $request->validate([
                'name' => 'nullable|string',
                'nip' => [
                    'nullable',
                    Rule::unique('users', 'nip')->ignore($user_id),
                ],
                'kota' => 'nullable|string',
                'alamat' => 'nullable|string',
                'agama' => 'nullable|string',
                'tanggal_lahir' => 'nullable|date',
                'no_hp' => [
                    'nullable',
                    Rule::unique('users', 'no_hp')->ignore($user_id),
                ],
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('users', 'email')->ignore($user_id),
                ],
                'password' => 'nullable|string',
                'jenis_kelamin' => 'nullable|string',
                'role_id' => 'nullable|exists:roles,id',
                'id_positions' => 'nullable|string',
                'gaji_posisi' => 'nullable|string',
                'tanggal_mulai' => 'nullable|date',
                'tanggal_selesai' => 'nullable|date',
                'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                // Add validation rules for other fields if needed
            ]);

            // Retrieve the user based on ID
            $user = User::findOrFail($user_id);

            // Handle the update for the profile image if provided
            if ($request->hasFile('foto_profil')) {
                // Delete the existing profile image (if any)
                if ($user->foto_profil) {
                    Storage::disk('public')->delete($user->foto_profil);
                }

                // Upload and store the new profile image with a custom name
                $uploadedFile = $request->file('foto_profil');
                $extension = $uploadedFile->getClientOriginalExtension();

                // Generate a unique filename based on the current timestamp
                $imageName = 'foto_profil_' . now()->timestamp . '.' . $extension;

                // Store the file using Storage
                $imagePath = $uploadedFile->storeAs('public/uploads/foto_profil', $imageName);

                // Save only the relative path to the user's foto_profil field in the database
                $validatedData['foto_profil'] = 'uploads/foto_profil/' . $imageName;
            }

            // Update the user using the validated data
            $user->update($validatedData);

            // Return a success JSON response
            return response()->json(['message' => 'User updated successfully', 'user' => $user]);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the update process
            return response()->json(['message' => 'Error updating user', 'error' => $e->getMessage()], 500);
        }
    }



    public function getUserById($user_id)
    {
        try {
            // Mengambil data pengguna berdasarkan ID
            $user = User::findOrFail($user_id);

            // Return data user dalam format JSON
            return response()->json(['data' => $user]);
        } catch (\Exception $exception) {
            // Mengembalikan pesan jika pengguna tidak ditemukan atau terjadi kesalahan lainnya
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
