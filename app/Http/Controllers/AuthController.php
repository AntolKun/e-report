<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $request->validate([
      'username' => 'required|string',
      'password' => 'required|string',
    ]);

    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
      $user = Auth::user();
      switch ($user->role) {
        case 'admin':
          return redirect()->route('adminDashboard');
        case 'guru':
          return redirect()->route('guru.classes');
        case 'siswa':
          // Redirect siswa to their classes page
          return redirect()->route('siswa.kelas');
      }
    }

    return back()->withErrors([
      'username' => 'Username atau password salah.',
    ]);
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/login');
  }
}

