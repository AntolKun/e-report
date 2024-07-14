<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Admin;

class AdminController extends Controller
{
  public function index()
  {
    return view('admin.Dashboard');
  }

  public function tambahAdmin()
  {
    $admins = Admin::with('user')->get();
    return view('admin.TambahAdmin', compact('admins'));
  }

  public function create()
  {
    return view('admin.FormTambahAdmin');
  }

  public function store(Request $request)
  {
    $request->validate([
      'username' => 'required|unique:users',
      'password' => 'required|min:6',
      'nama' => 'required',
      'email' => 'required|email|unique:admins',
      'foto' => 'nullable|image',
    ]);

    try {
      $user = User::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'role' => 'admin',
      ]);

      $fotoPath = null;
      if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->move(public_path('admin_fotos'), $request->file('foto')->getClientOriginalName());
      }

      Admin::create([
        'user_id' => $user->id,
        'nama' => $request->nama,
        'email' => $request->email,
        'foto' => $fotoPath ? 'admin_fotos/' . $request->file('foto')->getClientOriginalName() : null,
      ]);

      return redirect()->route('admin.TambahAdmin')->with('success', 'Data Berhasil Tersimpan');
    } catch (\Exception $e) {
      Log::error('Error storing admin: ' . $e->getMessage());
      return back()->with('error', 'Terjadi kesalahan, data gagal tersimpan');
    }
  }
}
