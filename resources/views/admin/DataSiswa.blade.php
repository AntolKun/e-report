@extends('layouts.UserTemplate')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Data Siswa</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Data Siswa</li>
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

<div class="row mb-3 justify-content-end">
  <div class="col-auto">
    <a href="{{ route('buatSiswa') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Tambah Siswa
    </a>
  </div>
</div>

<table id="dataSiswa" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>NISN</th>
      <th>Jenis Kelamin</th>
      <th>Email</th>
      <th>Nomor Telepon</th>
      <th>Foto</th>
      <th width="400px">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($siswas as $siswa)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $siswa->nama }}</td>
      <td>{{ $siswa->nisn }}</td>
      <td>{{ $siswa->jenis_kelamin }}</td>
      <td>{{ $siswa->email }}</td>
      <td>{{ $siswa->nomor_telepon }}</td>
      <td>
        @if ($siswa->foto)
        <img src="{{ asset($siswa->foto) }}" alt="Foto siswa" width="50" height="50">
        @else
        Tidak ada foto
        @endif
      </td>
      <td>
        <a class="btn btn-info" href="{{ route('showSiswa', $siswa->id) }}">Lihat Detail</a>
        <a class="btn btn-warning" href="{{ route('editSiswa', $siswa->id) }}">Edit</a>
        <button class="btn btn-danger" onclick="confirmDelete('{{ $siswa->id }}')">Delete</button>
        <form id="delete-form-{{ $siswa->id }}" action="{{ route('hapusSiswa', $siswa->id) }}" method="POST" style="display: none;">
          @csrf
          @method('DELETE')
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
  $(document).ready(function() {
    $('#dataSiswa').DataTable();
  });
</script>
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

<script>
  function confirmDelete(siswaId) {
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Data ini akan dihapus secara permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('delete-form-' + siswaId).submit();
      }
    })
  }
</script>
@endsection