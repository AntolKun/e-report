<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Siswa;

class AdminController extends Controller
{
  public function index()
  {
    $admin = Admin::count();
    $guru = Guru::count();
    $siswa = Siswa::count();
    return view('admin.Dashboard', compact('admin', 'guru', 'siswa'));
  }

  public function dataAdmin()
  {
    $admins = Admin::with('user')->get();
    return view('admin.DataAdmin', compact('admins'));
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

      return redirect()->route('dataAdmin')->with('success', 'Data Berhasil Tersimpan');
    } catch (\Exception $e) {
      Log::error('Error storing admin: ' . $e->getMessage());
      return back()->with('error', 'Terjadi kesalahan, data gagal tersimpan');
    }
  }

  public function destroy($id)
  {
    try {
      $admin = Admin::findOrFail($id);
      $user = $admin->user;

      // Hapus foto jika ada
      if ($admin->foto) {
        $fotoPath = public_path($admin->foto);
        if (file_exists($fotoPath)) {
          unlink($fotoPath);
        }
      }

      // Hapus admin dan user terkait
      $admin->delete();
      $user->delete();

      return redirect()->route('dataAdmin')->with('success', 'Data berhasil dihapus');
    } catch (\Exception $e) {
      Log::error('Error deleting admin: ' . $e->getMessage());
      return back()->with('error', 'Terjadi kesalahan, data gagal dihapus');
    }
  }

  public function edit($id)
  {
    $admin = Admin::with('user')->findOrFail($id);
    return view('admin.FormEditAdmin', compact('admin'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'username' => 'required|unique:users,username,' . $request->user_id,
      'password' => 'nullable|min:6',
      'nama' => 'required',
      'email' => 'required|email|unique:admins,email,' . $id,
      'foto' => 'nullable|image',
    ]);

    try {
      $admin = Admin::findOrFail($id);
      $user = User::findOrFail($admin->user_id);

      if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->move(public_path('admin_fotos'), $request->file('foto')->getClientOriginalName());
        $admin->foto = 'admin_fotos/' . $request->file('foto')->getClientOriginalName();
      }

      $admin->update([
        'nama' => $request->nama,
        'email' => $request->email,
      ]);

      $user->update([
        'username' => $request->username,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
      ]);

      return redirect()->route('dataAdmin')->with('success', 'Data Admin Berhasil Diperbarui');
    } catch (\Exception $e) {
      Log::error('Error updating admin: ' . $e->getMessage());
      return back()->with('error', 'Terjadi kesalahan, data gagal diperbarui');
    }
  }
}
