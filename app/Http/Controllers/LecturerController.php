<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Silabus;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\Absensi;
use App\Models\Nilai;
use Illuminate\Support\Facades\Hash;

class LecturerController extends Controller
{
    public function index(Request $request)
    {
        $idUser = $request->session()->get('id_user');
        $role = $request->session()->get('role');
        $dosen = Dosen::where('id_user', $idUser)->first();
        $jumlah_mahasiswa = Mahasiswa::count();
        $jumlah_pembelajaran = Silabus::count();
        $jumlah_absensi = Absensi::count();
        $jumlah_materi = Materi::count();
        $jumlah_tugas = Tugas::count();
        $jumlah_nilai = Nilai::count();
        return view('lecturer.dashboard', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
        ], compact('role', 'dosen', 'jumlah_mahasiswa', 'jumlah_pembelajaran', 'jumlah_materi', 'jumlah_absensi', 'jumlah_tugas', 'jumlah_nilai'));
    }

    public function getIdUser(Request $request, $id_dosen)
    {
        $dosen = Dosen::find($id_dosen);
        return view('lecturer.profile.edit', [
            'title' => 'Update Data Dosen',
            'active' => 'profile'
        ], compact('dosen'));
    }

    public function updateProfile(Request $request, $id_dosen)
    {
        $request->validate([
            'nip' => 'required|unique:dosen,nip,' . $id_dosen . ',id_dosen',
            'name' => 'required|unique:dosen,name,' . $id_dosen . ',id_dosen',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|unique:dosen,email,' . $id_dosen . ',id_dosen',
            'username' => 'required|unique:dosen,username,' . $id_dosen . ',id_dosen',
        ]);

        $idUser = $request->session()->get('id_user');
        $user = User::find($idUser);

        if ($user) {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();
        } else {
            toastr()->error('User not found!');
            return redirect()->back();
        }

        $dosen = Dosen::findOrFail($id_dosen);

        if ($dosen) {
            $dosen->nip = $request->nip;
            $dosen->name = $request->name;
            $dosen->jenis_kelamin = $request->jenis_kelamin;
            $dosen->tempat_lahir = $request->tempat_lahir;
            $dosen->tanggal_lahir = $request->tanggal_lahir;
            $dosen->alamat = $request->alamat;
            $dosen->no_hp = $request->no_hp;
            $dosen->email = $request->email;
            $dosen->username = $request->username;

            $dosen->save();
            toastr()->success('Update Lecturer success!');
        } else {
            toastr()->error('Lecturer not found!');
            return redirect()->route('dashboard');
        }

        return redirect()->route('dashboard');
    }
}
