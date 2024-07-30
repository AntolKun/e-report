@extends('layouts.UserTemplate')

@section('content')

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Edit Kelas</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="/adminDashboard">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Edit Kelas</li>
          </ol>
        </nav>
      </div>
      <div class="col-3">
        <div class="text-center mb-n5">
          <img src="{{ asset('dist/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
        </div>
      </div>
    </div>
  </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
  <strong>Error!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('updateKelas', $kelas->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-md-6 my-4">
      <div>
        <strong>Nama Kelas:</strong>
        <input type="text" class="form-control" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Tahun Ajaran:</strong>
        <select class="form-select" name="tahun_id">
          @foreach ($tahunAjarans as $tahun)
          <option value="{{ $tahun->id }}" {{ $kelas->tahun_id == $tahun->id ? 'selected' : '' }}>{{ $tahun->tahun_ajaran }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Guru:</strong>
        <select class="form-select" name="guru_id">
          @foreach ($gurus as $guru)
          <option value="{{ $guru->id }}" {{ $kelas->guru_id == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div>
      <button type="submit" class="mt-4 btn btn-rounded btn-success text-black">Update Kelas</button>
    </div>
  </div>
</form>

@endsection
