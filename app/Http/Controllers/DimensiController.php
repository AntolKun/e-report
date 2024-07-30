<?php

namespace App\Http\Controllers;

use App\Models\Dimensi;
use Illuminate\Http\Request;

class DimensiController extends Controller
{
    public function index()
    {
        $dimensi = Dimensi::all();
        return view('guru.DataDimensi', compact('dimensi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dimensi' => 'required|string|max:255',
        ]);

        Dimensi::create($request->all());

        return redirect()->route('DataDimensi')->with('success', 'Dimensi berhasil ditambahkan.');
    }

    // public function edit(Dimensi $dimensi)
    // {
    //     return view('dimensi.edit', compact('dimensi'));
    // }

    public function update(Request $request, Dimensi $dimensi)
    {
        $request->validate([
            'dimensi' => 'required|string|max:255',
        ]);

        $dimensi->update($request->all());

        return redirect()->route('DataDimensi')->with('success', 'Dimensi berhasil diperbarui.');
    }

    public function destroy(Dimensi $dimensi)
    {
        $dimensi->delete();

        return redirect()->route('DataDimensi')->with('success', 'Dimensi berhasil dihapus.');
    }
}
