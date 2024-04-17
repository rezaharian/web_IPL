<?php

namespace App\Http\Controllers\admin;

use App\Helpers\LogActivity as HelpersLogActivity;
use App\Http\Controllers\Controller;
use App\Models\detail_user;
use App\Models\log_user_login;
use App\Models\logActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LogActivity as GlobalLogActivity;
use Illuminate\Support\Facades\Crypt;


class masterUserController extends Controller
{
    public function index()
    {

        $users = User::leftJoin('detail_users', 'users.id', '=', 'detail_users.user_id')->get();
        // dd($users->toArray());

        return view('admin.dashboard.masterUser.index', compact('users'));
    }
    public function create()
    {

        return view('admin.dashboard.masterUser.create');
    }
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'email|unique:users',
            'password' => 'nullable|string|min:6', // Allow nullable password
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_rumah' => 'required|string|max:255',
            'blok' => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:255',
        ]);

        $password = $validatedData['password'] ?? '11111111';

        // Create a new user along with associated details
        $user = DB::transaction(function () use ($validatedData, $password) {
            // Create a new user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($password),
            ]);

            // Create details for the user with the same ID
            $user->detailUser()->create([
                'nama_lengkap' => $validatedData['nama_lengkap'],
                'alamat' => $validatedData['alamat'],
                'nomor_rumah' => $validatedData['nomor_rumah'],
                'blok' => $validatedData['blok'],
                'nomor_telepon' => $validatedData['nomor_telepon'],
                'pekerjaan' => $validatedData['pekerjaan'],
                'status_perkawinan' => $validatedData['status_perkawinan'],
            ]);

            return $user;
        });
        // GlobalLogActivity::addToLog();
        // dd('log insert successfully.');
        return redirect()->route('admin.masteruser.index');
    }

    public function edit($encryptedId)
    {
        // Mendekripsi ID
        $hashedInput = substr($encryptedId, 0, 6);
        $users = detail_user::all(); // Assuming this fetches all users

        // Iterate through users to find the matching ID
        foreach ($users as $user) {
            if (substr(hash('sha256', $user->id), 0, 6) === $hashedInput) {
                $duser = $user;
                break;
            }
        }

        // Check if user is found
        if (!isset($duser)) {
            abort(404); // Or handle the error accordingly
        }

        // Perform any necessary logic for editing (e.g., fetching related data)

        // Pass the user data to the view
        return view('admin.dashboard.masterUser.edit', ['duser' => $duser]);
    }


    public function update(Request $request, $encryptedId)
    {
        // Mendekripsi ID
        $id = Crypt::decryptString($encryptedId);

        // Temukan pengguna berdasarkan ID yang didekripsi
        $user = User::find($id);

        // Pastikan pengguna ditemukan
        if (!$user) {
            // Tindakan jika pengguna tidak ditemukan, misalnya tampilkan pesan kesalahan atau redirect ke halaman lain
            abort(404);
        }
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_rumah' => 'required|string|max:255',
            'blok' => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status_perkawinan' => 'nullable|string|max:255',
        ]);

        // Update the user details
        $user = User::find($id);
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        // Update the detail_user details
        $detailUser = detail_user::where('user_id', $id)->first();
        $detailUser->update([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'alamat' => $validatedData['alamat'],
            'nomor_rumah' => $validatedData['nomor_rumah'],
            'blok' => $validatedData['blok'],
            'nomor_telepon' => $validatedData['nomor_telepon'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'status_perkawinan' => $validatedData['status_perkawinan'],
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.masteruser.index')->with('success', 'User updated successfully!');
    }
    public function destroy($id)
    {
        // Find the user by ID
        $duser = detail_user::find($id);

        // If the user exists, delete it along with associated detail_user
        if ($duser) {
            // Delete the associated detail_user
            User::where('id', $duser->user_id)->delete();

            // Delete the user
            $duser->delete();

            // Redirect back with a success message
            return redirect()->route('admin.masteruser.index')->with('success', 'User deleted successfully!');
        } else {
            // Redirect back with an error message (optional)
            return redirect()->route('admin.masteruser.index')->with('error', 'User not found!');
        }
    }

    public function log_user_login()
    {
        $logs = log_user_login::with('user')->orderBy('login_time', 'desc')->get();
        // Memuat relasi 'user'

        return view('admin.dashboard.log_login.index', compact('logs'));
    }
}