<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminTahunAjaranController extends Controller
{
  public function index()
  {
    $tahunAjaran = TahunAjaran::all();
    return view('admin.DataTahunAjaran', compact('tahunAjaran'));
  }

  public function create()
  {
    return view('admin.FormTambahTahunAjaran');
  }

  public function store(Request $request)
  {
    $request->validate([
      'tahun_ajaran' => 'required|string|unique:tahun_ajaran',
    ]);

    try {
      TahunAjaran::create([
        'tahun_ajaran' => $request->tahun_ajaran,
      ]);

      return redirect()->route('dataTahunAjaran')->with('success', 'Tahun Ajaran berhasil disimpan.');
    } catch (\Exception $e) {
      Log::error('Error storing tahun ajaran: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Terjadi kesalahan, data Tahun Ajaran gagal disimpan.');
    }
  }

  public function edit($id)
  {
    $tahunAjaran = TahunAjaran::findOrFail($id);
    return view('admin.FormEditTahunAjaran', compact('tahunAjaran'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'tahun_ajaran' => 'required|unique:tahun_ajaran'
    ]);

    try {
      $tahunAjaran = TahunAjaran::findOrFail($id);

      $tahunAjaran->update([
        'tahun_ajaran' => $request->tahun_ajaran,
      ]);

      return redirect()->route('dataTahunAjaran')->with('success', 'Data Tahun Ajaran berhasil diperbarui.');
    } catch (\Exception $e) {
      Log::error('Error updating tahun ajaran: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Terjadi kesalahan, data Tahun Ajaran gagal diperbarui.');
    }
  }

  public function destroy($id)
  {
    try {
      $tahunAjaran = TahunAjaran::findOrFail($id);

      $tahunAjaran->delete();

      return redirect()->route('dataTahunAjaran')->with('success', 'Data Tahun Ajaran Berhasil Dihapus');
    } catch (\Exception $e) {
      Log::error('Error deleting tahun ajar: ' . $e->getMessage());
      return back()->with('error', 'Terjadi kesalahan, data gagal dihapus');
    }
  }
}
