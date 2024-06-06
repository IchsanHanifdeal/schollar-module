<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register', [
            'title' => 'Register as a student',
            'jurusan' => Jurusan::all()
        ]);
    }

    public function storeStudent(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'nim' => 'required|numeric|unique:mahasiswa',
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'jurusan' => 'required',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role ?? 'mahasiswa',
            ]);

            if (!$user) {
                toastr()->error('Failed to register as a student!');
                return redirect()->back();
            }

            $userID = $user->id_user;

            $mahasiswa = Mahasiswa::create([
                'id_user' => $userID,
                'id_jurusan' => $request->jurusan,
                'nim' => $request->nim,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);

            if (!$mahasiswa) {
                toastr()->error('Failed to register as a student!');
                DB::rollBack();
                return redirect()->back();
            }

            DB::commit();

            toastr()->success('Register as a student success!');
            return redirect()->route('login');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('An error occurred. Please try again later.');
            return redirect()->back();
        }
    }

    public function lecturer()
    {
        return view('register_lecturer', [
            'title' => 'Register as a lecturer'
        ]);
    }

    public function storeLecturer(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'nip' => 'required|numeric|unique:dosen',
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role ?? 'dosen',
            ]);

            if (!$user) {
                toastr()->error('Failed to register as a student!');
                return redirect()->back();
            }

            $userID = $user->id_user;

            $dosen = Dosen::create([
                'id_user' => $userID,
                'nip' => $request->nip,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);

            if (!$dosen) {
                toastr()->error('Failed to register as a lecturer!');
                DB::rollBack();
                return redirect()->back();
            }

            DB::commit();

            toastr()->success('Register as a lecturer success!');
            return redirect()->route('login');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('An error occurred. Please try again later.');
            return redirect()->back();
        }
    }
}
