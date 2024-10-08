<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminSiswaController extends Controller
{
  public function index()
  {
    $siswas = Siswa::all();
    return view('admin.DataSiswa', compact('siswas'));
  }

  public function create()
  {
    return view('admin.FormTambahSiswa');
  }

  public function store(Request $request)
  {
    $request->validate([
      'username' => 'required|unique:users',
      'password' => 'required|min:6',
      'nama' => 'required',
      'nisn' => 'required|unique:siswas',
      'jenis_kelamin' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required|date',
      'agama' => 'required',
      'email' => 'required|email|unique:siswas',
      'nomor_telepon' => 'required|unique:siswas',
      'foto' => 'nullable|image',
    ]);

    try {
      $user = User::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'role' => 'siswa',
      ]);

      $fotoPath = null;
      if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('siswa_fotos'), $fotoPath);
      }

      Siswa::create([
        'user_id' => $user->id,
        'nama' => $request->nama,
        'nisn' => $request->nisn,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'agama' => $request->agama,
        'email' => $request->email,
        'nomor_telepon' => $request->nomor_telepon,
        'foto' => $fotoPath ? 'siswa_fotos/' . $request->file('foto')->getClientOriginalName() : null,
      ]);

      return redirect()->route('dataSiswa')->with('success', 'Data Siswa berhasil disimpan.');
    } catch (\Exception $e) {
      Log::error('Error storing siswa: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Terjadi kesalahan, data Siswa gagal disimpan.');
    }
  }

  public function show($id)
  {
    $siswa = Siswa::findOrFail($id);
    return view('admin.ShowDetailSiswa', compact('siswa'));
  }

  public function edit($id)
  {
    $siswa = Siswa::findOrFail($id);
    return view('admin.FormEditSiswa', compact('siswa'));
  }

  public function update(Request $request, $id)
  {
    $siswa = Siswa::findOrFail($id);
    $user = User::findOrFail($siswa->user_id);

    $request->validate([
      'username' => 'required|unique:users,username,' . $user->id,
      'password' => 'nullable|min:6',
      'nama' => 'required',
      'nisn' => 'required|unique:siswas,nisn,' . $id,
      'jenis_kelamin' => 'required',
      'tempat_lahir' => 'required',
      'tanggal_lahir' => 'required|date',
      'agama' => 'required',
      'email' => 'required|email|unique:siswas,email,' . $id,
      'nomor_telepon' => 'required|unique:siswas,nomor_telepon,' . $id,
      'foto' => 'nullable|image',
    ]);

    try {
      if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($siswa->foto && file_exists(public_path('siswa_fotos/' . $siswa->foto))) {
          unlink(public_path('siswa_fotos/' . $siswa->foto));
        }

        // Upload foto baru
        $fotoPath = $request->file('foto')->move(public_path('siswa_fotos'), $request->file('foto')->getClientOriginalName());
        $siswa->foto = 'siswa_fotos/' . $request->file('foto')->getClientOriginalName();
      }

      $siswa->update([
        'nama' => $request->nama,
        'nisn' => $request->nisn,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'agama' => $request->agama,
        'email' => $request->email,
        'nomor_telepon' => $request->nomor_telepon,
      ]);

      $user->update([
        'username' => $request->username,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
      ]);

      return redirect()->route('dataSiswa')->with('success', 'Data Siswa Berhasil Diperbarui');
    } catch (\Exception $e) {
      Log::error('Error updating siswa: ' . $e->getMessage());
      return back()->with('error', 'Terjadi kesalahan, data gagal diperbarui');
    }
  }

  public function destroy($id)
  {
    try {
      $siswa = Siswa::findOrFail($id);
      $user = User::findOrFail($siswa->user_id);

      // Hapus foto jika ada
      if ($siswa->foto && file_exists(public_path($siswa->foto))) {
        unlink(public_path($siswa->foto));
      }

      $siswa->delete();
      $user->delete();

      return redirect()->route('dataSiswa')->with('success', 'Data Siswa Berhasil Dihapus');
    } catch (\Exception $e) {
      Log::error('Error deleting siswa: ' . $e->getMessage());
      return back()->with('error', 'Terjadi kesalahan, data gagal dihapus');
    }
  }
}
