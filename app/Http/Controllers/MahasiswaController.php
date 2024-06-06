<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $daftar_jurusan = Jurusan::all();
        $mahasiswa = Mahasiswa::with('jurusan')->get();

        $selectedJurusan = $mahasiswa->isEmpty() ? null : $mahasiswa->first()->id_jurusan;

        return view('lecturer.mahasiswa', [
            'title' => 'Mahasiswa',
            'active' => 'mahasiswa',
            'mahasiswa' => $mahasiswa,
            'daftar_jurusan' => $daftar_jurusan,
            'selectedJurusan' => $selectedJurusan,
            'role' => $request->session()->get('role'),
        ]);
    }

    public function update(Request $request, $id_mahasiswa)
    {

        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $id_mahasiswa . ',id_mahasiswa',
            'name' => 'required|unique:mahasiswa,name,' . $id_mahasiswa . ',id_mahasiswa',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'username' => 'required|unique:mahasiswa,username,' . $id_mahasiswa . ',id_mahasiswa',
            'email' => 'required|unique:mahasiswa,email,' . $id_mahasiswa . ',id_mahasiswa',
        ]);

        $mahasiswa = Mahasiswa::findorFail($id_mahasiswa);
        $id_user = $mahasiswa->id_user;
        $user = User::find($id_user);

        if ($user) {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();
        } else {
            toastr()->error('User not found!');
            return redirect()->back();
        }


        if ($mahasiswa) {
            $mahasiswa->nim = $request->nim;
            $mahasiswa->name = $request->name;
            $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
            $mahasiswa->tempat_lahir = $request->tempat_lahir;
            $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
            $mahasiswa->alamat = $request->alamat;
            $mahasiswa->no_hp = $request->no_hp;
            $mahasiswa->username = $request->username;
            $mahasiswa->email = $request->email;

            $mahasiswa->save();
            toastr()->success('Update Student Success!');
        } else {
            toastr()->error('Student not found');
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id_mahasiswa)
    {
        $data = Mahasiswa::find($id_mahasiswa);

        if ($data) {
            $data->delete();
            toastr('Comment deleted!', 'success');
        } else {
            toastr('Data not found!', 'error');
        }

        return redirect()->back();
    }

    public function store_tugas(Request $request, $id_tugas)
    {
        $request->validate([
            'id_tugas' => 'required',
            'id_matakuliah' => 'required',
            'id_mahasiswa' => 'required',
            'lampiran_tugas' => 'nullable|file'
        ]);
        $namaFile = null;

        if ($request->hasFile('lampiran_tugas')) {
            $lampiran_tugas = $request->file('lampiran_tugas');
            $namaFile = time() . '-' . $lampiran_tugas->getClientOriginalName();
            $lampiran_tugas->storeAs('public/lampiran_tugas/mahasiswa', $namaFile);
        }

        Nilai::create([
            'id_tugas' => $request->id_tugas,
            'id_matakuliah' => $request->id_matakuliah,
            'id_mahasiswa' => $request->id_mahasiswa,
            'tanggal_pengumpulan' => now(),
            'file' => $namaFile,
        ]);

        return redirect()->back()->with('success', 'Task Input Success');
    }
}
