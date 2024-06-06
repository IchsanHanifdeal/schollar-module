<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function index() {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userRole = Auth::user()->role;

            if ($userRole == 'dosen') {
                $request->session()->regenerate();
                $user = Auth::user();
                $request->session()->put('id_user', $user->id_user);
                $request->session()->put('name', $user->name);
                $request->session()->put('username', $user->username);
                $request->session()->put('email', $user->email);
                $request->session()->put('role', $user->role);
                return redirect()->intended('dashboard')->with('success', 'Login successful!');
            } elseif ($userRole == 'mahasiswa') {
                $request->session()->regenerate();
                $user = Auth::user();
                $request->session()->put('id_user', $user->id_user);
                $request->session()->put('name', $user->name);
                $request->session()->put('username', $user->username);
                $request->session()->put('email', $user->email);
                $request->session()->put('role', $user->role);
                return redirect()->intended('dashboard')->with('success', 'Login successful!');
            }

            return back()->with('loginError', 'Login failed, user role not recognized.');
        }

        toastr()->error('Incorrect username or password.');

        return back()->withErrors([
            'loginError' => 'Incorrect username or password.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        toastr()->success('Logout Success, You have been logged out');

        return redirect('/');
    }
}
