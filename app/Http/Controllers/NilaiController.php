<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\RekapNilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request)
    {

        $id_user = $request->session()->get('id_user');
        $Role = $request->session()->get('role');
        return view('lecturer.nilai', [
            'title' => 'Rekap Nilai',
            'active' => 'nilai',
            'role' => $Role,
            'rekapnilai' => RekapNilai::all(),
            'mahasiswa' => Mahasiswa::all(),
            'id_user' => $id_user,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'id_mahasiswa' => 'required|integer',
            'nilai_uts' => 'required',
            'nilai_uas' => 'required',
        ]);

        RekapNilai::create([
            'id_mahasiswa' => $request->id_mahasiswa,
            'nilai_uts' => $request->nilai_uts,
            'nilai_uas' => $request->nilai_uas,
        ]);

        return redirect()->back()->with('success', 'Rekap Nilai Success');
    }

    public function update(Request $request, $id_rekap_nilai) {
        $request->validate([
            'id_mahasiswa' => 'required|integer',
            'nilai_uts' => 'required',
            'nilai_uas' => 'required',
        ]);

        $rekapNilai = RekapNilai::findOrFail($id_rekap_nilai);

        $rekapNilai->update([
            'id_mahasiswa' => $request->id_mahasiswa,
            'nilai_uts' => $request->nilai_uts,
            'nilai_uas' => $request->nilai_uas,
        ]);

        return redirect()->back()->with('success', 'Update Rekap Nilai Success');
    }

    public function destroy(Request $request, $id_rekap_nilai) {
        $data = RekapNilai::find($id_rekap_nilai);

        if ($data) {

            $data->delete();
            toastr('Data deleted!', 'success');
        } else {
            toastr('Data not found!', 'error');
        }

        return redirect()->back();
    }

    public function update_nilai_tugas(Request $request, $id_nilai)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $nilai = Nilai::findOrFail($id_nilai);

        $nilai->nilai = $request['nilai'];
        $nilai->keterangan = 'Dinilai';

        $nilai->save();

        toastr('Berhasil dinilai!', 'success');
        return redirect()->back();
    }
}
