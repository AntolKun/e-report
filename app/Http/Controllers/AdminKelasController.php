<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminKelasController extends Controller
{
  public function index()
  {
    $kelas = Kelas::with(['tahunAjaran', 'guru'])->get();
    return view('admin.dataKelas', compact('kelas'));
  }

  public function create()
  {
    $tahunAjarans = TahunAjaran::all();
    $gurus = Guru::all();
    return view('kelas.create', compact('tahunAjarans', 'gurus'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama_kelas' => 'required',
      'tahun_id' => 'required|exists:tahun_ajaran,id',
      'guru_id' => 'required|exists:gurus,id',
    ]);

    try {
      Kelas::create([
        'nama_kelas' => $request->nama_kelas,
        'tahun_id' => $request->tahun_id,
        'guru_id' => $request->guru_id,
      ]);

      return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil disimpan.');
    } catch (\Exception $e) {
      Log::error('Error storing kelas: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Terjadi kesalahan, data Kelas gagal disimpan.');
    }
  }

  public function edit($id)
  {
    $kelas = Kelas::findOrFail($id);
    $tahunAjarans = TahunAjaran::all();
    $gurus = Guru::all();
    return view('kelas.edit', compact('kelas', 'tahunAjarans', 'gurus'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama_kelas' => 'required',
      'tahun_id' => 'required|exists:tahun_ajaran,id',
      'guru_id' => 'required|exists:gurus,id',
    ]);

    try {
      $kelas = Kelas::findOrFail($id);

      $kelas->update([
        'nama_kelas' => $request->nama_kelas,
        'tahun_id' => $request->tahun_id,
        'guru_id' => $request->guru_id,
      ]);

      return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil diperbarui.');
    } catch (\Exception $e) {
      Log::error('Error updating kelas: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Terjadi kesalahan, data Kelas gagal diperbarui.');
    }
  }

  public function destroy($id)
  {
    try {
      $kelas = Kelas::findOrFail($id);
      $kelas->delete();
      return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil dihapus.');
    } catch (\Exception $e) {
      Log::error('Error deleting kelas: ' . $e->getMessage());
      return back()->with('error', 'Terjadi kesalahan, data Kelas gagal dihapus.');
    }
  }
}
