@extends('layouts.UserTemplate')
@section('css')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Tambah Data Guru</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted " href="/guruDashboard">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Tambah data guru</li>
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
    <a href="{{ route('buatGuru') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Tambah Guru
    </a>
  </div>
</div>

<table id="dataguru" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
      <th>Tanggal Lahir</th>
      <th>Agama</th>
      <th>Email</th>
      <th>Nomor Telepon</th>
      <th>Username</th>
      <th>Foto</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($gurus as $guru)
    <tr>
      <td>{{ $guru->nama }}</td>
      <td>{{ $guru->jenis_kelamin }}</td>
      <td>{{ $guru->tanggal_lahir }}</td>
      <td>{{ $guru->agama }}</td>
      <td>{{ $guru->email }}</td>
      <td>{{ $guru->nomor_telepon }}</td>
      <td>{{ $guru->user->username }}</td>
      <td>
        @if ($guru->foto)
        <img src="{{ asset($guru->foto) }}" alt="Foto guru" width="50" height="50">
        @else
        Tidak ada foto
        @endif
      </td>
      <td>
        <a href="{{ route('showGuru', $guru->id) }}" class="btn btn-info">Lihat Detail</a>
        <a href="{{ route('editGuru', $guru->id) }}" class="btn btn-warning">Edit</a>
        <button class="btn btn-danger" onclick="confirmDelete('{{ $guru->id }}')">Delete</button>
        <form id="delete-form-{{ $guru->id }}" action="{{ route('hapusGuru', $guru->id) }}" method="POST" style="display: none;">
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
  $(document).ready(function() {
    $('#dataguru').DataTable();
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
  function confirmDelete(guruId) {
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
        document.getElementById('delete-form-' + guruId).submit();
      }
    })
  }
</script>


@endsection