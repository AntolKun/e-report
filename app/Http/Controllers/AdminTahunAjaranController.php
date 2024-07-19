<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class AdminTahunAjaranController extends Controller
{
  public function index()
  {
    $tahunAjarans = TahunAjaran::all();
    return view('admin.DataTahunAjaran', compact('tahunAjarans'));
  }

  public function create()
  {
    return view('tahun_ajaran.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'tahun_ajaran' => 'required|unique:tahun_ajarans,tahun_ajaran',
    ]);

    TahunAjaran::create($request->all());

    return redirect()->route('tahunAjaran.index')->with('success', 'Tahun Ajaran berhasil ditambahkan.');
  }

  public function edit(TahunAjaran $tahunAjaran)
  {
    return view('tahun_ajaran.edit', compact('tahunAjaran'));
  }

  public function update(Request $request, TahunAjaran $tahunAjaran)
  {
    $request->validate([
      'tahun_ajaran' => 'required|unique:tahun_ajarans,tahun_ajaran,' . $tahunAjaran->id,
    ]);

    $tahunAjaran->update($request->all());

    return redirect()->route('tahunAjaran.index')->with('success', 'Tahun Ajaran berhasil diperbarui.');
  }

  public function destroy(TahunAjaran $tahunAjaran)
  {
    $tahunAjaran->delete();

    return redirect()->route('tahunAjaran.index')->with('success', 'Tahun Ajaran berhasil dihapus.');
  }
}
