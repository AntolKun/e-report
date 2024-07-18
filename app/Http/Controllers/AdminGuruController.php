<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminGuruController extends Controller
{
  public function index()
  {
    $gurus = Guru::all();
    return view('admin.DataGuru', compact('gurus'));
  }

  public function create()
  {
    return view('admin.FormTambahGuru');
  }

  public function store(Request $request)
  {
    $request->validate([
      'username' => 'required|unique:users',
      'password' => 'required|min:6',
      'nama' => 'required',
      'jenis_kelamin' => 'required',
      'tanggal_lahir' => 'required|date',
      'agama' => 'required',
      'email' => 'required|email|unique:gurus',
      'nomor_telepon' => 'required|unique:gurus',
      'foto' => 'nullable|image',
    ]);

    try {
      $user = User::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'role' => 'guru',
      ]);

      $fotoPath = null;
      if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('guru_fotos'), $fotoPath);
      }

      Guru::create([
        'user_id' => $user->id,
        'nama' => $request->nama,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tanggal_lahir' => $request->tanggal_lahir,
        'agama' => $request->agama,
        'email' => $request->email,
        'nomor_telepon' => $request->nomor_telepon,
        'foto' => $fotoPath ? 'guru_fotos/' . $request->file('foto')->getClientOriginalName() : null ,
      ]);

      return redirect()->route('dataGuru')->with('success', 'Data Guru berhasil disimpan.');
    } catch (\Exception $e) {
      Log::error('Error storing guru: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Terjadi kesalahan, data Guru gagal disimpan.');
    }
  }

  // public function show($id)
  // {
  //   $guru = Guru::with('user')->findOrFail($id);
  //   return view('admin.ShowDetailGuru', compact('guru'));
  // }

  public function show(Guru $guru)
  {
    return view('admin.ShowDetailGuru', compact('guru'));
  }

  public function edit($id)
  {
    $guru = Guru::with('user')->findOrFail($id);
    return view('admin.FormEditGuru', compact('guru'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'username' => 'required|unique:users,username,' . $request->user_id,
      'password' => 'nullable|min:6',
      'nama' => 'required',
      'jenis_kelamin' => 'required',
      'tanggal_lahir' => 'required|date',
      'agama' => 'required',
      'email' => 'required|email|unique:gurus,email,' . $id,
      'nomor_telepon' => 'required|unique:gurus,nomor_telepon,' . $id,
      'foto' => 'nullable|image',
    ]);

    try {
      $guru = Guru::findOrFail($id);
      $user = User::findOrFail($guru->user_id);

      if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($guru->foto && file_exists(public_path('guru_fotos/' . $guru->foto))) {
          unlink(public_path('guru_fotos/' . $guru->foto));
        }

        // Upload foto baru
        $fotoPath = $request->file('foto')->move(public_path('guru_fotos'), $request->file('foto')->getClientOriginalName());
        $guru->foto = 'guru_fotos/' . $request->file('foto')->getClientOriginalName();
      }

      $guru->update([
        'nama' => $request->nama,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tanggal_lahir' => $request->tanggal_lahir,
        'agama' => $request->agama,
        'email' => $request->email,
        'nomor_telepon' => $request->nomor_telepon,
      ]);

      $user->update([
        'username' => $request->username,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
      ]);

      return redirect()->route('dataGuru')->with('success', 'Data Guru Berhasil Diperbarui');
    } catch (\Exception $e) {
      Log::error('Error updating guru: ' . $e->getMessage());
      return back()->with('error', 'Terjadi kesalahan, data gagal diperbarui');
    }
  }

  public function destroy($id)
  {
    try {
      $guru = Guru::findOrFail($id);
      $user = $guru->user;

      // Hapus foto jika ada
      if ($guru->foto) {
        $fotoPath = public_path($guru->foto);
        if (file_exists($fotoPath)) {
          unlink($fotoPath);
        }
      }

      // Hapus guru dan user terkait
      $guru->delete();
      $user->delete();

      return redirect()->route('dataGuru')->with('success', 'Data berhasil dihapus');
    } catch (\Exception $e) {
      Log::error('Error deleting guru: ' . $e->getMessage());
      return back()->with('error', 'Terjadi kesalahan, data gagal dihapus');
    }
  }
}