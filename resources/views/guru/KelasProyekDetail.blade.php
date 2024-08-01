@extends('layouts.GuruTemplate')

@section('content')
<div class="container">
  <h1>Detail Proyek</h1>
  <h2>{{ $proyek->tema_proyek }}</h2>
  <p><strong>Dimensi:</strong> {{ $proyek->dimensi->dimensi }}</p>
  <p><strong>Elemen 1:</strong> {{ $proyek->elemen_1 }}</p>
  <p><strong>Sub Elemen:</strong> {{ $proyek->sub_elemen }}</p>
  <p><strong>Tanggal Deadline:</strong> {{ $proyek->tanggal_deadline }}</p>

  <h3>Status Pengerjaan Siswa</h3>
  <table class="table">
    <thead>
      <tr>
        <th>Nama Siswa</th>
        <th>Status</th>
        <th>Link File</th>
      </tr>
    </thead>
    <tbody>
      @foreach($proyek->proyekSiswa as $ps)
      <tr>
        <td>{{ $ps->siswa->nama }}</td>
        <td>
          @if($ps->status)
          <span class="badge bg-success">Sudah Mengerjakan</span>
          @else
          <span class="badge bg-danger">Belum Mengerjakan</span>
          @endif
        </td>
        <td>
          @if($ps->file_link)
          <a href="{{ $ps->file_link }}" target="_blank">Lihat File</a>
          @else
          -
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection