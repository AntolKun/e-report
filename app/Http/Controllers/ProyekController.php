<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\Dimensi;
use App\Models\ProyekSiswa;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\SiswaProyek;

use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
  public function index(Request $request)
  {
    // Ambil data kelas dan proyek
    $guru = Auth::user()->guru;
    $kelasId = $request->input('kelas_id');
    $query = Proyek::where('guru_id', $guru->id);

    if ($kelasId) {
      $query->where('kelas_id', $kelasId);
    }

    $proyek = $query->get();
    $kelas = $guru->kelas; // Asumsi guru memiliki relasi dengan kelas

    // Ambil data dimensi
    $dimensi = Dimensi::all();

    return view('guru.DataProyek', compact('proyek', 'kelas', 'dimensi'));
  }

  public function store(Request $request)
  {
    $user = Auth::user();
    if (!$user || !$user->guru) {
      return redirect()->route('proyek.index')->with('error', 'Data guru tidak ditemukan.');
    }

    $request->validate([
      'tema_proyek' => 'required|string|max:255',
      'dimensi_id' => 'required|integer|exists:dimensi,id',
      'elemen_1' => 'required|string|max:255',
      'sub_elemen' => 'required|string|max:255',
      'tanggal_deadline' => 'required|date',
      'kelas_id' => 'required|integer|exists:kelas,id',
    ]);

    Proyek::create([
      'tema_proyek' => $request->tema_proyek,
      'dimensi_id' => $request->dimensi_id,
      'elemen_1' => $request->elemen_1,
      'sub_elemen' => $request->sub_elemen,
      'tanggal_deadline' => $request->tanggal_deadline,
      'kelas_id' => $request->kelas_id,
      'guru_id' => $user->guru->id,
    ]);

    return redirect()->route('proyek.index')->with('success', 'Proyek berhasil ditambahkan.');
  }

  public function update(Request $request, Proyek $proyek)
  {
    $request->validate([
      'tema_proyek' => 'required|string|max:255',
      'dimensi_id' => 'required|integer|exists:dimensi,id',
      'kelas_id' => 'required|integer|exists:kelas,id',
      'elemen_1' => 'required|string|max:255',
      'sub_elemen' => 'required|string|max:255',
      'tanggal_deadline' => 'required|date',
    ]);

    $proyek->update([
      'tema_proyek' => $request->tema_proyek,
      'dimensi_id' => $request->dimensi_id,
      'kelas_id' => $request->kelas_id,
      'elemen_1' => $request->elemen_1,
      'sub_elemen' => $request->sub_elemen,
      'tanggal_deadline' => $request->tanggal_deadline,
    ]);

    return redirect()->route('proyek.index')->with('success', 'Proyek berhasil diupdate.');
  }


  public function destroy(Proyek $proyek)
  {
    $proyek->delete();

    return redirect()->route('proyek.index')->with('success', 'Proyek berhasil dihapus.');
  }

  public function showSiswa(Proyek $proyek)
  {
    $proyekSiswa = ProyekSiswa::where('proyek_id', $proyek->id)
      ->with('siswa')
      ->get();

    $data = $proyekSiswa->map(function ($sp) {
      return [
        'nama' => $sp->siswa->nama,
        'status' => $sp->status,
        'file_path' => $sp->file_path,
        'file_link' => $sp->file_link,
      ];
    });

    return response()->json($data);
  }

  public function getSiswa($proyekId)
  {
    $proyek = Proyek::with('siswa')->find($proyekId);
    return response()->json($proyek->siswa);
  }

  public function show($id)
  {
    // Memuat proyek bersama dengan proyekSiswa dan siswa terkait
    $proyek = Proyek::with('proyekSiswa.siswa')->findOrFail($id);
    return view('guru.KelasProyekDetail', compact('proyek'));
  }

  public function downloadFile($id, $fileName)
  {
    $userRole = Auth::user()->role;

    if ($userRole === 'guru') {
      $proyekSiswa = ProyekSiswa::where('proyek_id', $id)->first(); // Teachers can access all submissions
    } elseif ($userRole === 'siswa') {
      $proyekSiswa = ProyekSiswa::where('proyek_id', $id)
        ->where('siswa_id', Auth::user()->siswa->id)
        ->first();
    } else {
      return back()->with('error', 'Unauthorized access.');
    }

    if (!$proyekSiswa || !$proyekSiswa->file_path) {
      return back()->with('error', 'File not found.');
    }

    // The file is now stored in the public/uploads/proyek directory
    $filePath = public_path($proyekSiswa->file_path);

    if (!file_exists($filePath)) {
      return back()->with('error', 'File not found. Path: ' . $filePath);
    }

    return response()->download($filePath, basename($filePath), [
      'Content-Type' => mime_content_type($filePath),
      'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"'
    ]);
  }

}
