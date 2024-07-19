@extends('layouts.UserTemplate')

@section('content')

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Edit Data Siswa</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="/adminDashboard">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Edit data siswa</li>
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

<form action="{{ route('updateSiswa', $siswa->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-md-6 my-4">
      <div>
        <strong>Username:</strong>
        <input type="text" class="form-control" name="username" value="{{ old('username', $siswa->user->username) }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Password:</strong>
        <input type="password" class="form-control" name="password">
        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Nama:</strong>
        <input type="text" class="form-control" name="nama" value="{{ old('nama', $siswa->nama) }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>NISN:</strong>
        <input type="text" class="form-control" name="nisn" value="{{ old('nisn', $siswa->nisn) }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Jenis Kelamin:</strong>
        <select class="form-select" name="jenis_kelamin">
          <option value="Laki-Laki" {{ $siswa->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
          <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Tempat Lahir:</strong>
        <input type="text" class="form-control" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Tanggal Lahir:</strong>
        <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Agama:</strong>
        <select class="form-select" name="agama">
          <option value="Islam" {{ $siswa->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
          <option value="Kristen" {{ $siswa->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
          <option value="Katolik" {{ $siswa->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
          <option value="Hindu" {{ $siswa->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
          <option value="Buddha" {{ $siswa->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
          <option value="Konghucu" {{ $siswa->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
        </select>
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Email:</strong>
        <input type="email" class="form-control" name="email" value="{{ old('email', $siswa->email) }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Nomor Telepon:</strong>
        <input type="text" class="form-control" name="nomor_telepon" value="{{ old('nomor_telepon', $siswa->nomor_telepon) }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Foto:</strong>
        <input type="file" class="form-control" name="foto">
        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto</small>
      </div>
    </div>
    <div class="col-md-6 my-4 text-center">
      <strong>Foto:</strong>
      @if ($siswa->foto)
      <img src="{{ asset($siswa->foto) }}" alt="Foto siswa" class="img-fluid" style="max-width: 100%;">
      @else
      <p>Tidak ada foto</p>
      @endif
    </div>
    <div>
      <button type="submit" class="mt-4 btn btn-rounded btn-success text-black">Perbarui Siswa</button>
    </div>
  </div>
</form>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($message = session()->get('success'))
<script type="text/javascript">
  Swal.fire({
    icon: 'success',
    title: 'Sukses!',
    text: '{{ $message }}',
  })
</script>
@endif

@if ($message = session()->get('error'))
<script type="text/javascript">
  Swal.fire({
    icon: 'error',
    title: 'Waduh!',
    text: '{{ $message }}',
  })
</script>
@endif
@endsection