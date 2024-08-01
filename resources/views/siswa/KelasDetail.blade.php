@extends('layouts.SiswaTemplate')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <h4 class="fw-semibold mb-8">Detail Kelas: {{ $class->nama_kelas }}</h4>
    <p>Tahun Ajaran: {{ $class->tahunAjaran->tahun_ajaran }}</p>
    <div class="row">
      <h5>Proyek di Kelas Ini:</h5>
      @if($class->proyek->isEmpty())
      <p>Tidak ada proyek dalam kelas ini.</p>
      @else
      @foreach ($class->proyek as $proyek)
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">{{ $proyek->tema_proyek }}</h5>
            <p class="card-text">Dimensi: {{ $proyek->dimensi->dimensi ?? 'N/A' }}</p>
            <p class="card-text">Deadline: {{ $proyek->tanggal_deadline }}</p>
            <a href="{{ route('siswa.proyek.detail', $proyek->id) }}" class="btn btn-primary">Kerjakan Proyek</a>
          </div>
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>
</div>
@endsection