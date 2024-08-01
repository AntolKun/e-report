<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;

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
    $class = Kelas::with('tahunAjaran', 'proyek')->findOrFail($id);
    return view('siswa.KelasDetail', compact('class'));
  }
}
