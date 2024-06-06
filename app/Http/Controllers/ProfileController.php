<?php

namespace App\Http\Controllers;

use App\Models\dosen;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request) {
        $idUser = $request->session()->get('id_user');
        $dosen = Dosen::where('id_user', $idUser)->first();
        return view('lecturer.profile', [
            'title' => 'Profile',
            'active' => 'profile'
        ], compact ('dosen'));
    }
}
