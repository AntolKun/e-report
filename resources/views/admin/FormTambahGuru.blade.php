@extends('layouts.UserTemplate')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Tambah Data Guru</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="/adminDashboard">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Tambah Data Guru</li>
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
<div>
  <strong>Error!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('buatGuruStore') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-md-6 my-4">
      <div>
        <strong>Username:</strong>
        <input type="text" class="form-control" name="username" value="{{ old('username') }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Password:</strong>
        <input type="password" class="form-control" name="password">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Nama:</strong>
        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Jenis Kelamin:</strong>
        <select class="form-select" name="jenis_kelamin">
          <option value="Laki-Laki">Laki-Laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Tanggal Lahir:</strong>
        <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Agama:</strong>
        <select class="form-select" name="agama">
          <option value="Islam">Islam</option>
          <option value="Kristen">Kristen</option>
          <option value="Katolik">Katolik</option>
          <option value="Hindu">Hindu</option>
          <option value="Buddha">Buddha</option>
          <option value="Lainnya">Lainnya</option>
        </select>
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Email:</strong>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Nomor Telepon:</strong>
        <input type="text" class="form-control" name="nomor_telepon" value="{{ old('nomor_telepon') }}">
      </div>
    </div>
    <div class="col-md-6 my-4">
      <div>
        <strong>Foto:</strong>
        <input type="file" class="form-control" name="foto">
      </div>
    </div>
    <div>
      <button type="submit" class="mt-4 btn btn-rounded btn-success text-black">Tambah Guru</button>
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