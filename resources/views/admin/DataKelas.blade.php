@extends('layouts.UserTemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Data Kelas</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted " href="/guruDashboard">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Data kelas</li>
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
    <a href="{{ route('buatKelas') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Tambah Kelas
    </a>
  </div>
</div>

<table id="datakelas" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Kelas</th>
      <th>Tahun Ajaran</th>
      <th>Guru</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($kelas as $index => $kls)
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $kls->nama_kelas }}</td>
      <td>{{ $kls->tahunAjaran->tahun_ajaran }}</td>
      <td>{{ $kls->guru->nama }}</td>
      <td>
        <a href="{{ route('dataKelasSiswa', $kls->id) }}" class="btn btn-info">Tambah Murid</a>
        <a href="{{ route('editKelas', $kls->id) }}" class="btn btn-warning">Edit</a>
        <button class="btn btn-danger" onclick="confirmDelete('{{ $kls->id }}')">Delete</button>
        <form id="delete-form-{{ $kls->id }}" action="{{ route('hapusKelas', $kls->id) }}" method="POST" style="display: none;">
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
    $('#datakelas').DataTable();
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
  function confirmDelete(kelasId) {
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
        document.getElementById('delete-form-' + kelasId).submit();
      }
    })
  }
</script>


@endsection