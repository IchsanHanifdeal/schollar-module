<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request) {
        $idUser = $request->session()->get('id_user');
        return view ('student.dashboard', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
        ], compact ('idUser'));
    }
}
