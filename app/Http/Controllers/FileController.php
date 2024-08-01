<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class FileController extends Controller
{
  public function downloadFile($id, $file)
  {
    // Mengambil path file dari direktori publik
    $filePath = public_path('uploads/proyek/' . $file);

    if (file_exists($filePath)) {
      return Response::download($filePath);
    } else {
      return redirect()->route('siswa.proyek.detail')->with('error', 'File tidak ditemukan.');
    }
  }
}
