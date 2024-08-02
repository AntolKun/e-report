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
    // Update validation rules: both fields are optional, but at least one must be provided
    $request->validate([
      'file' => 'nullable|file|mimes:pdf,docx,zip,xlsx,xls,ppt,pptx,jpeg,jpg,png,mp4,avi,mkv,zip,rar|max:5120',
      'file_link' => 'nullable|url',
    ]);

    $proyek = Proyek::find($id);

    if (!$proyek) {
      return redirect()->route('siswa.proyek.detail', $id)->with('error', 'Proyek not found.');
    }

    $user = Auth::user();

    if (!$user) {
      return redirect()->route('login')->with('error', 'User not authenticated.');
    }

    $siswa = $user->siswa;

    if (!$siswa) {
      return redirect()->route('login')->with('error', 'Siswa record not found.');
    }

    $filePath = null;
    if ($request->hasFile('file')) {
      $file = $request->file('file');
      $fileName = time() . '-' . $file->getClientOriginalName();
      $filePath = 'uploads/proyek/' . $fileName;
      $file->move(public_path('uploads/proyek'), $fileName);
    }

    $fileLink = $request->input('file_link');

    // Ensure that at least one of filePath or fileLink is provided
    if (is_null($filePath) && is_null($fileLink)) {
      return redirect()->route('siswa.proyek.detail', $id)->with('error', 'Kirimkan File atau Link (pilih salah satu)');
    }

    ProyekSiswa::updateOrCreate(
      [
        'proyek_id' => $proyek->id,
        'siswa_id' => $siswa->id,
      ],
      [
        'file_path' => $filePath,
        'file_link' => $fileLink,
        'status' => true,
      ]
    );

    return redirect()->route('siswa.proyek.detail', $id)->with('success', 'Pekerjaan berhasil disubmit.');
  }

  public function downloadFile($id, $fileName)
  {
    $proyekSiswa = ProyekSiswa::where('proyek_id', $id)
      ->where('siswa_id', Auth::user()->siswa->id)
      ->first();

    if (!$proyekSiswa || !$proyekSiswa->file_path) {
      return back()->with('error', 'File not found.');
    }

    $filePath = public_path('uploads/proyek/' . $fileName);

    if (!file_exists($filePath)) {
      return back()->with('error', 'File not found.');
    }

    return response()->download($filePath, $fileName, [
      'Content-Type' => mime_content_type($filePath),
      'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
    ]);
  }
}
