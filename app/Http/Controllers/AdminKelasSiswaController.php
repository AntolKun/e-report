<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\KelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminKelasSiswaController extends Controller
{
  public function index($kelasId)
  {
    $kelas = Kelas::with(['tahunAjaran', 'guru'])->findOrFail($kelasId);
    $assignedSiswaIds = KelasSiswa::where('kelas_id', $kelasId)->pluck('siswa_id')->toArray();
    $siswas = Siswa::whereNotIn('id', $assignedSiswaIds)->get();
    $assignedSiswas = KelasSiswa::where('kelas_id', $kelasId)->get();

    return view('admin.DataKelasSiswa', compact('kelas', 'siswas', 'assignedSiswas'));
  }

  public function store(Request $request, $kelasId)
  {
    $request->validate([
      'siswa_id' => 'required|exists:siswas,id',
    ]);

    try {
      KelasSiswa::create([
        'kelas_id' => $kelasId,
        'siswa_id' => $request->siswa_id,
      ]);

      return redirect()->route('dataKelas', $kelasId)->with('success', 'Siswa berhasil ditambahkan ke kelas.');
    } catch (\Exception $e) {
      Log::error('Error assigning siswa to kelas: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Terjadi kesalahan, siswa gagal ditambahkan ke kelas.');
    }
  }

  public function destroy($kelasId, $id)
  {
    try {
      $kelasSiswa = KelasSiswa::findOrFail($id);
      $kelasSiswa->delete();

      return redirect()->route('dataKelasSiswa', $kelasId)->with('success', 'Siswa berhasil dihapus dari kelas.');
    } catch (\Exception $e) {
      Log::error('Error deleting siswa from kelas: ' . $e->getMessage());
      return back()->with('error', 'Terjadi kesalahan, siswa gagal dihapus dari kelas.');
    }
  }
}
