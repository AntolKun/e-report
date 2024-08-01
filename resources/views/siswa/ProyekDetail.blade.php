@extends('layouts.SiswaTemplate')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <h4 class="fw-semibold mb-8">Proyek: {{ $proyek->tema_proyek }}</h4>
    <p>Dimensi: {{ $proyek->dimensi->dimensi ?? 'N/A' }}</p>
    <p>Tanggal Deadline: {{ $proyek->tanggal_deadline }}</p>
    <p>Kelas: {{ $proyek->kelas->nama_kelas }}</p>

    @php
      $submitted = $proyek->siswa->contains(Auth::user()->siswa->id);
      $proyekSiswa = \App\Models\ProyekSiswa::where('proyek_id', $proyek->id)
      ->where('siswa_id', Auth::user()->siswa->id)
      ->first();
    @endphp

    @if ($submitted && $proyekSiswa && $proyekSiswa->status)
      <p class="text-success">Status: Sudah Mengerjakan</p>
      <p>File yang diupload:
        <a href="{{ route('siswa.proyek.download', ['id' => $proyek->id, 'fileName' => basename($proyekSiswa->file_path)]) }}" download>
          {{ basename($proyekSiswa->file_path) }}
        </a>
      </p>
      @if ($proyekSiswa->file_link)
        <p>Link yang diupload: <a href="{{ $proyekSiswa->file_link }}" target="_blank">{{ $proyekSiswa->file_link }}</a></p>
      @endif
    @else
      <p class="text-warning">Status: Belum Mengerjakan</p>
      <a href="{{ route('siswa.proyek.submit', $proyek->id) }}" class="btn btn-primary">Submit Your Work</a>
    @endif
  </div>
</div>
@endsection
