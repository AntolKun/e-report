@extends('layouts.GuruTemplate')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <h4 class="fw-semibold mb-8">Kelas Anda</h4>
    <div class="row">
      @if($classes->isEmpty())
      <p>Tidak ada kelas yang terhubung dengan Anda.</p>
      @else
      @foreach ($classes as $class)
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">{{ $class->nama_kelas }}</h5>
            <p class="card-text">Tahun Ajaran: {{ $class->tahunAjaran->tahun_ajaran }}</p>
            <a href="{{ route('guru.kelas.detail', $class->id) }}" class="btn btn-primary">Detail</a>
          </div>
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>
</div>
@endsection