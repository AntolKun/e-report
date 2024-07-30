<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
  public function showLoginForm()
  {
    return view('auth.Login');
  }

  public function login(Request $request)
  {
    $credentials = $request->only('username', 'password');

    $request->validate([
      'username' => 'required',
      'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
      $user = Auth::user();
      return redirect()->intended('/dashboard')->with('success', 'Login berhasil!');
    }

    return back()->withErrors([
      'username' => 'The provided credentials do not match our records.',
    ])->onlyInput('username');
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/login')->with('success', 'Logout berhasil!');
  }
}
