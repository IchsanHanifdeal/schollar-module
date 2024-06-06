<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Silabus;
use App\Models\Komentar;
use Illuminate\Support\Facades\Storage;

class PembelajaranController extends Controller
{
    public function index(Request $request)
    {
        $id_user_log = $request->session()->get('id_user');
        $Role = $request->session()->get('role');
        $silabus = Silabus::all();
        $komentar = Komentar::all();
        return view('lecturer.pembelajaran', [
            'title' => 'Pembelajaran',
            'active' => 'pembelajaran',
            'silabus' => $silabus,
            'id_user' => $id_user_log,
            'komentar' => $komentar,
            'role' => $Role,
        ]);
    }

    public function store_silabus(Request $request) {
        $validatedData = $request->validate([
            'nama_silabus' => 'required',
            'deskripsi' => 'required',
            'file_silabus' => 'nullable|file',
            'tipe_file' => 'required',
        ]);

        $savedData = Silabus::create([
            'nama_silabus' => $validatedData['nama_silabus'],
            'deskripsi' => $validatedData['deskripsi'],
            'tipe_file' => $validatedData['tipe_file'],
            'file_silabus' => $validatedData['file_silabus'],
        ]);

        if($request->file('file_silabus')) {
            $file_path = $request->file('file_silabus')->store('public/silabus');
            $savedData->file_silabus = str_replace('public/', '', $file_path);
            $savedData->save();
        }

        toastr('Data Saved!', 'success');
        return redirect()->route('pembelajaran');
    }

    public function update_silabus(Request $request, $id_silabus) {
        $validatedData = $request->validate([
            'nama_silabus' => 'required',
            'deskripsi' => 'required',
            'file_silabus' => 'nullable|file',
            'tipe_file' => 'required',
        ]);
    
        $silabus = Silabus::findOrFail($id_silabus);
    
        $silabus->nama_silabus = $validatedData['nama_silabus'];
        $silabus->deskripsi = $validatedData['deskripsi'];
    
        if($request->File('file_silabus')) {
            Storage::delete($silabus->file_silabus);
            $file_path = $request->file('file_silabus')->store('public/silabus');
            $silabus->file_silabus = str_replace('public/', '', $file_path);
            $silabus->save();
            
        }
    
        $silabus->save();
    
        toastr('Data Updated!', 'success');
        return redirect()->route('pembelajaran');
    }

    public function tambah_komentar(Request $request, $id_silabus)
    {
        $validatedData = $request->validate([
            'komentar' => 'required',
            'id_user' => 'required',
            'id_silabus' => 'required',
        ]);

        $savedData = Komentar::create($validatedData);

        if ($savedData) {
            toastr('Comment Posted!', 'success');
            return redirect()->route('pembelajaran');
        } else {
            toastr('Failed to post comment.', 'error');
            return back();
        }
    }

    public function hapus_komentar(Request $request, $id_komentar) {
        $data = Komentar::find($id_komentar);
        
        if ($data) {
            $data->delete();
           toastr('Comment deleted!', 'success');
        } else {
            toastr('Data not found!', 'error');
        }
    
        return redirect()->route('pembelajaran');
    }

    public function hapus_silabus(Request $request, $id_silabus) {
        $data = Silabus::find($id_silabus);
        
        if ($data) {
            if ($data->file_silabus) {
                if (Storage::exists($data->file_silabus)) {
                    Storage::delete($data->file_silabus);
                }
            }

            $data->delete();
           toastr('Data deleted!', 'success');
        } else {
            toastr('Data not found!', 'error');
        }
    
        return redirect()->route('pembelajaran');
    }
}
