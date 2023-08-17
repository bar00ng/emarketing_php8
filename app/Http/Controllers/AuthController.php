<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm() {
        return view('auth.login');
    }

    public function loginAction(Request $req) {
        $validated = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'email' => 'Format :attribute tidak valid.',
            'min' => ':Attribute harus memiliki minimal :min karakter.',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($validated)) {
            // Authentication successful
            return redirect()->route('dashboard');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function registerForm() {
        return view('auth.register');
    }

    public function registerAction(Request $req) {
        $validated = $req->validate([
            'first_name' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'no_telp'=> 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255',
            'password' => 'required|min:6',
        ]);

        if($req->filled('last_name')) {
            $validated['last_name'] = $req->last_name;
        }

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'no_telp' => $validated['no_telp'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $user->addRole('user');

        return back()->with('success', 'Proses register berhasil!');
    }

    public function logout() {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
