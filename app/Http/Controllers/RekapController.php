<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Tugas;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $matakuliah = MataKuliah::all();
        $role = $request->session()->get('role');
        $id_user = $request->session()->get('id_user');
        $mahasiswa = Mahasiswa::where('id_user', $id_user)->first();
        $name = $request->session()->get('name');
        $tugas = Tugas::all();
        $nilai = [];
        foreach ($tugas as $tugasItem) {
            $nilai[$tugasItem->id_tugas] = Nilai::where('id_tugas', $tugasItem->id_tugas)->get();
        }
        return view('lecturer.tugas', [
            'title' => 'Rekap Tugas',
            'active' => 'tugas',
            'role' => $role,
            'name' => $name,
            'id_mahasiswa' => $mahasiswa,
        ], compact('tugas', 'matakuliah', 'nilai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_matakuliah' => 'required',
            'judul_tugas' => 'required',
            'deskripsi' => 'required',
            'lampiran_tugas' => 'nullable|file'
        ]);

        $namaFile = null;

        if ($request->hasFile('lampiran_tugas')) {
            $lampiran_tugas = $request->file('lampiran_tugas');
            $namaFile = time() . '-' . $lampiran_tugas->getClientOriginalName();
            $lampiran_tugas->storeAs('public/lampiran_tugas', $namaFile);
        }

        Tugas::create([
            'id_matakuliah' => $request->id_matakuliah,
            'judul_tugas' => $request->judul_tugas,
            'deskripsi' => $request->deskripsi,
            'lampiran_tugas' => $namaFile,
        ]);

        return redirect()->route('rekap_tugas')->with('success', 'Task Input Success');
    }

    public function destroy(Request $request, $id_tugas)
    {
        $data = Tugas::find($id_tugas);

        if ($data) {
            if ($data->lampiran_tugas) {
                if (Storage::exists($data->lampiran_tugas)) {
                    Storage::delete($data->lampiran_tugas);
                }
            }

            $data->delete();
            toastr('Data deleted!', 'success');
        } else {
            toastr('Data not found!', 'error');
        }

        return redirect()->route('rekap_tugas');
    }

    public function update(Request $request, $id_tugas) {
        $validatedData = $request->validate([
            'id_matakuliah' => 'required',
            'judul_tugas' => 'required',
            'deskripsi' => 'required',
            'lampiran_tugas' => 'nullable|file',
        ]);
    
        $tugas = Tugas::findOrFail($id_tugas);
    
        $tugas->id_matakuliah = $validatedData['id_matakuliah'];
        $tugas->judul_tugas = $validatedData['judul_tugas'];
        $tugas->deskripsi = $validatedData['deskripsi'];
    
        if ($request->hasFile('lampiran_tugas')) {
            if ($tugas->lampiran_tugas) {
                Storage::delete($tugas->lampiran_tugas);
            }
            
            $lampiran_tugas = $request->file('lampiran_tugas');
            $namaFile = time() . '.' . $lampiran_tugas->extension();
            $lampiran_tugas->storeAs('public/lampiran_tugas', $namaFile);
            
            $tugas->lampiran_tugas = $namaFile;
        }

        $tugas->save();

        toastr('Data Updated!', 'success');
        return redirect()->route('rekap_tugas');
    }

}
