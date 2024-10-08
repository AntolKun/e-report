@extends('layouts.UserTemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Data Tahun Ajaran</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="/adminDashboard">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Tahun Ajaran</li>
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
    <a href="{{ route('buatTahunAjaran') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Tambah Tahun Ajaran
    </a>
  </div>
</div>

<table id="dataTable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Tahun Ajaran</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($tahunAjaran as $index => $tahunAjaran)
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $tahunAjaran->tahun_ajaran }}</td>
      <td>
        <a href="{{ route('editTahunAjaran', $tahunAjaran->id) }}" class="btn btn-warning">Edit</a>
        <button class="btn btn-danger" onclick="confirmDelete('{{ $tahunAjaran->id }}')">Delete</button>
        <form id="delete-form-{{ $tahunAjaran->id }}" action="{{ route('hapusTahunAjaran', $tahunAjaran->id) }}" method="POST" style="display: none;">
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
    $('#dataTable').DataTable();
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
  function confirmDelete(tahunAjaranId) {
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
        document.getElementById('delete-form-' + tahunAjaranId).submit();
      }
    })
  }
</script>
@endsection