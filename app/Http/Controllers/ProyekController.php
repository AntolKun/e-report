<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\Dimensi;
use App\Models\ProyekSiswa;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\SiswaProyek;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
  public function index(Request $request)
  {
    $guru = Auth::user()->guru;
    $kelasId = $request->input('kelas_id');
    $query = Proyek::where('guru_id', $guru->id);

    if ($kelasId) {
      $query->where('kelas_id', $kelasId);
    }

    $proyek = $query->get();
    $kelas = $guru->kelas;

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
    $proyek = Proyek::with('proyekSiswa.siswa')->findOrFail($id);
    return view('guru.KelasProyekDetail', compact('proyek'));
  }

  public function downloadFile($id, $fileName)
  {
    $proyekSiswa = ProyekSiswa::where('proyek_id', $id)->first();

    if (!$proyekSiswa || !$proyekSiswa->file_path) {
      return back()->with('error', 'File not found.');
    }

    $filePath = public_path($proyekSiswa->file_path);

    if (!file_exists($filePath)) {
      return back()->with('error', 'File not found. Path: ' . $filePath);
    }

    return response()->download($filePath, $fileName, [
      'Content-Type' => mime_content_type($filePath),
      'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
    ]);
  }

  public function updateKeterangan(Request $request, $id)
  {
    $request->validate([
      'keterangan' => 'nullable|string',
    ]);

    $proyekSiswa = ProyekSiswa::find($id);
    if (!$proyekSiswa) {
      return back()->with('error', 'Record tidak ditemukan.');
    }

    $proyekSiswa->keterangan = $request->input('keterangan');
    $proyekSiswa->save();

    return back()->with('success', 'Keterangan berhasil diperbarui.');
  }

  public function saveKeterangan(Request $request, $id)
  {
    $request->validate([
      'keterangan' => 'required|string',
      'siswa_id' => 'required|integer|exists:siswas,id',
    ]);

    $proyekSiswa = ProyekSiswa::where('proyek_id', $id)
      ->where('siswa_id', $request->siswa_id)
      ->firstOrFail();

    $proyekSiswa->keterangan = $request->keterangan;
    $proyekSiswa->save();

    return redirect()->route('proyek.show', $id)->with('success', 'Keterangan berhasil disimpan.');
  }

  public function generatePdf($id)
  {
    $proyek = Proyek::with(['proyekSiswa.siswa', 'kelas', 'dimensi'])->findOrFail($id);

    // Pastikan $proyek->kelas memiliki data
    $data = $proyek->proyekSiswa->where('status', true)->map(function ($ps) {
      return [
        'nama' => $ps->siswa->nama,
        'status' => $ps->status ? 'Sudah Mengerjakan' : 'Belum Mengerjakan',
        'file_link' => $ps->file_link ? 'Ada' : 'Tidak Ada',
        'file_path' => $ps->file_path ? 'Ada' : 'Tidak Ada',
        'tanggal_submit' => $ps->updated_at->format('d-m-Y H:i:s'),
        'keterangan' => $ps->keterangan,
      ];
    });

    $pdf = FacadePdf::loadView('guru.RaportPDF', [
      'proyek' => $proyek,
      'data' => $data,
    ]);

    return $pdf->download('raport-proyek-' . $proyek->id . '.pdf');
  }

}
