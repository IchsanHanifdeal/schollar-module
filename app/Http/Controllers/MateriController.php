<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\komentar_materi;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $id_user_log = $request->session()->get('id_user');
        $Role = $request->session()->get('role');
        $materi = Materi::all();
        $komentar = Komentar_Materi::all();
        return view('lecturer.materi', [
            'title' => 'Materi',
            'active' => 'materi',
            'role' => $Role,
        ], compact('materi', 'id_user_log', 'komentar'));
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'tipe_materi' => 'required',
            'file_materi' => 'nullable|file',
            'judul_materi' => 'required',
            'deskripsi' => 'required',
        ]);

        $savedData = Materi::create([
            'tipe_materi' => $validatedData['tipe_materi'],
            'file_materi' => $validatedData['file_materi'],
            'judul_materi' => $validatedData['judul_materi'],
            'deskripsi' => $validatedData['deskripsi'],
        ]);

        if ($request->file('file_materi')) {
            $file_path = $request->file('file_materi')->store('public/materi');
            $savedData->file_materi = str_replace('public/', '', $file_path);
            $savedData->save();
        }

        toastr('Data Saved!', 'success');
        return redirect()->route('materi');
    }

    public function update(Request $request, $id_materi)
    {
        $validatedData = $request->validate([
            'tipe_materi' => 'required',
            'file_materi' => 'nullable|file',
            'judul_materi' => 'required',
            'deskripsi' => 'required',
        ]);
    
        $materi = Materi::findOrFail($id_materi);
    
        $materi->judul_materi = $validatedData['judul_materi'];
        $materi->deskripsi = $validatedData['deskripsi'];
    
        if($request->File('file_materi')) {
            Storage::delete($materi->file_materi);
            $file_path = $request->file('file_materi')->store('public/materi');
            $materi->file_materi = str_replace('public/', '', $file_path);
            $materi->save();
            
        }
    
        $materi->save();
    
        toastr('Data Updated!', 'success');
        return redirect()->route('materi');
    }

    public function destroy(Request $request, $id_materi)
    {
        $materi = Materi::find($id_materi);

        if ($materi) {
            if ($materi->file_materi) {
                if (Storage::exists($materi->file_materi)) {
                    Storage::delete($materi->file_materi);
                }
            }

            $materi->delete();

            toastr('Data deleted!', 'success');
        } else {
            toastr('Data not found!', 'error');
        }

        return redirect()->route('materi');
    }

    public function tambah_komentar(Request $request, $id_materi)
    {
        $komentar = komentar_materi::all();
        $validatedData = $request->validate([
            'komentar' => 'nullable',
            'id_user' => 'required',
            'id_materi' => 'required',
        ]);

        $savedData = komentar_materi::create([
            'komentar' => $validatedData['komentar'],
            'id_user' => $validatedData['id_user'],
            'id_materi' => $validatedData['id_materi'],
        ]);

        $savedData->save();
        toastr('Comment Posted!', 'success');
        return redirect()->route('materi');
    }

    public function hapus_komentar(Request $request, $id_komentar)
    {
        $data = komentar_materi::find($id_komentar);

        if ($data) {
            $data->delete();
            toastr('Comment deleted!', 'success');
        } else {
            toastr('Data not found!', 'error');
        }

        return redirect()->route('materi');
    }
}
