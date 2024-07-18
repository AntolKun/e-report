@extends('layouts.UserTemplate')

@section('content')
<div class="card">
  <div class="card-header">
    <h3>Detail Guru: {{ $guru->nama }}</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-8">
        <div class="row mb-3">
          <div class="col-md-4">
            <strong>Nama:</strong>
          </div>
          <div class="col-md-8">
            {{ $guru->nama }}
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <strong>Jenis Kelamin:</strong>
          </div>
          <div class="col-md-8">
            {{ $guru->jenis_kelamin }}
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <strong>Tanggal Lahir:</strong>
          </div>
          <div class="col-md-8">
            {{ $guru->tanggal_lahir }}
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <strong>Agama:</strong>
          </div>
          <div class="col-md-8">
            {{ $guru->agama }}
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <strong>Email:</strong>
          </div>
          <div class="col-md-8">
            {{ $guru->email }}
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <strong>Nomor Telepon:</strong>
          </div>
          <div class="col-md-8">
            {{ $guru->nomor_telepon }}
          </div>
        </div>
      </div>
      <div class="col-md-4 text-center">
        <strong>Foto:</strong>
        @if ($guru->foto)
        <img src="{{ asset($guru->foto) }}" alt="Foto guru" class="img-fluid" style="max-width: 100%;">
        @else
        <p>Tidak ada foto</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection