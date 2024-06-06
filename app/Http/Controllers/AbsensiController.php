<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request) {

        $absensi = Absensi::all();
        $role = $request->session()->get('role');
        return view ('lecturer.absensi', [
            'title' => 'Absensi',
            'active' => 'absensi',
            'absensi' => $absensi,
            'role' => $role,
        ]);
    }

    public function tambah_absensi (Request $request) {
        $absensi = Absensi::all();
        $name = $request->session()->get('name');
        $id_user = $request->session()->get('id_user');
        $role = $request->session()->get('role');
        return view ('lecturer.absensi.create', [
            'title' => 'Absensi',
            'active' => 'absensi',
            'absensi' => $absensi,
            'name' => $name,
            'role' => $role,
            'id_user' => $id_user,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'lokasi' => 'required|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $foto = $request->file('foto');
        $namaFoto = time() . '.' . $foto->extension();
        $foto->storeAs('public/absensi', $namaFoto);
        $id_user = $request->session()->get('id_user');

        Absensi::create([
            'id_user' => $id_user,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'lokasi' => $request->lokasi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'foto' => $namaFoto,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('absensi')->with('success', 'Absensi Success');
    }

    public function terima(Request $request, $id_absensi)
    {
        $absensi = Absensi::findOrFail($id_absensi);
        $absensi->status = 'izin (diterima)';
        $absensi->save();

        return back()->with('success', 'Izin Diterima.');
    }

    public function tolak(Request $request, $id_absensi)
    {
        $absensi = Absensi::findOrFail($id_absensi);
        $absensi->status = 'izin (ditolak)';
        $absensi->save();

        return back()->with('success', 'Izin Ditolak.');
    }
}
