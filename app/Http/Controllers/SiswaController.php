<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Proyek;
use App\Models\ProyekSiswa;

class SiswaController extends Controller
{
  public function myClasses()
  {
    // Get the logged-in user
    $user = Auth::user();

    // Assuming the user is authenticated and is a 'siswa'
    $siswa = Siswa::where('user_id', $user->id)->first();

    // Check if the siswa is found
    if ($siswa) {
      // Fetch classes associated with the logged-in siswa
      $classes = $siswa->kelas()->with('tahunAjaran')->get();

      return view('siswa.KelasSiswa', compact('classes'));
    } else {
      // Handle the case where no corresponding siswa is found
      return redirect()->route('login')->with('error', 'User not associated with any student.');
    }
  }

  public function detail($id)
  {
    $class = Kelas::with('tahunAjaran', 'proyek.dimensi')->findOrFail($id);
    return view('siswa.KelasDetail', compact('class'));
  }

  public function proyekDetail($id)
  {
    $proyek = Proyek::with('dimensi', 'kelas')->findOrFail($id);
    return view('siswa.ProyekDetail', compact('proyek'));
  }

  public function submitWorkForm($id)
  {
    $proyek = Proyek::find($id);

    // Check if Proyek exists
    if (!$proyek) {
      return redirect()->route('home')->with('error', 'Proyek not found.');
    }

    return view('siswa.ProyekSubmit', compact('proyek'));
  }

  public function submitWork(Request $request, $id)
  {
    // Validasi request
    $request->validate([
      'file' => 'required|file|mimes:pdf,docx,zip|max:2048',
      'file_link' => 'nullable|url',
    ]);

    // Temukan proyek berdasarkan ID
    $proyek = Proyek::find($id);

    if (!$proyek) {
      return redirect()->route('siswa.index')->with('error', 'Proyek not found.');
    }

    // Ambil user yang sedang login
    $user = Auth::user();

    if (!$user) {
      return redirect()->route('login')->with('error', 'User not authenticated.');
    }

    // Ambil siswa terkait
    $siswa = $user->siswa;

    if (!$siswa) {
      return redirect()->route('login')->with('error', 'Siswa record not found.');
    }

    // Proses upload file
    $filePath = null;
    if ($request->hasFile('file')) {
      $file = $request->file('file');
      $fileName = time() . '-' . $file->getClientOriginalName();
      $filePath = $file->move(public_path('uploads/proyek'), $fileName);
      $filePath = 'uploads/proyek/' . $fileName;
    }

    // Simpan data proyek siswa
    ProyekSiswa::updateOrCreate(
      [
        'proyek_id' => $proyek->id,
        'siswa_id' => $siswa->id,
      ],
      [
        'file_path' => $filePath,
        'file_link' => $request->input('file_link'), // Simpan link yang diinputkan
        'status' => true, // Gunakan nilai boolean true untuk status sudah mengerjakan
      ]
    );

    return redirect()->route('siswa.proyek.detail')->with('success', 'Pekerjaan berhasil disubmit.');
  }

  public function downloadFile($id, $fileName)
  {
    // Temukan proyek siswa berdasarkan ID proyek dan ID siswa
    $proyekSiswa = ProyekSiswa::where('proyek_id', $id)
      ->where('siswa_id', Auth::user()->siswa->id)
      ->first();

    if (!$proyekSiswa || !$proyekSiswa->file_path) {
      return redirect()->route('siswa.index')->with('error', 'File not found.');
    }

    // Tentukan path lengkap ke file di folder public
    $filePath = public_path('uploads/proyek/' . $fileName);

    // Cek apakah file ada
    if (!file_exists($filePath)) {
      return redirect()->route('siswa.index')->with('error', 'File not found.');
    }

    // Unduh file
    return response()->download($filePath);
  }
}
