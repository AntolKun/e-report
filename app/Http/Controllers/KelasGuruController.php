<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Support\Facades\Auth;

class KelasGuruController extends Controller
{
  public function myClasses()
  {
    // Get the logged-in user
    $user = Auth::user();

    // Assuming the user is authenticated and is a 'guru'
    $guru = Guru::where('user_id', $user->id)->first();

    // Check if the guru is found
    if ($guru) {
      // Fetch classes associated with the logged-in guru
      $classes = $guru->kelas()->with('tahunAjaran')->get();

      return view('guru.KelasGuru', compact('classes'));
    } else {
      // Handle the case where no corresponding guru is found
      return redirect()->route('login')->with('error', 'User not associated with any teacher.');
    }
  }

  public function detail($id)
  {
    $class = Kelas::with('tahunAjaran', 'proyek')->findOrFail($id);
    return view('guru.KelasDetail', compact('class'));
  }

  public function show($id)
  {
    $class = Kelas::with('proyek', 'proyek.dimensi')->findOrFail($id);
    return view('guru.KelasDetail', compact('class'));
  }
}
