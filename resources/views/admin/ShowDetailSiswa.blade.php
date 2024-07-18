@extends('layouts.UserTemplate')
@section('content')

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Detail Data Siswa</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Detail data siswa</li>
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

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4>Informasi Siswa</h4>
      </div>
      <div class="card-body">
        <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
        <p><strong>NISN:</strong> {{ $siswa->nisn }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin }}</p>
        <p><strong>Tempat Lahir:</strong> {{ $siswa->tempat_lahir }}</p>
        <p><strong>Tanggal Lahir:</strong> {{ $siswa->tanggal_lahir }}</p>
        <p><strong>Agama:</strong> {{ $siswa->agama }}</p>
        <p><strong>Email:</strong> {{ $siswa->email }}</p>
        <p><strong>Nomor Telepon:</strong> {{ $siswa->nomor_telepon }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h4>Foto Siswa</h4>
      </div>
      <div class="card-body text-center">
        @if ($siswa->foto)
        <img src="{{ asset($siswa->foto) }}" alt="Foto siswa" class="img-fluid" style="max-width: 100%; height: auto;">
        @else
        <p>Tidak ada foto</p>
        @endif
      </div>
    </div>
  </div>
</div>

<div class="row mt-3">
  <div class="col">
    <a class="btn btn-primary" href="{{ route('dataSiswa') }}">Kembali</a>
  </div>
</div>

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