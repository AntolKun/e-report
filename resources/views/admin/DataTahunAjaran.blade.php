@extends('layouts.UserTemplate')
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

<div class="card">
  <div class="card-body">
    <a href="{{ route('buatTahunAjaran') }}" class="btn btn-primary mb-3">Tambah Tahun Ajaran</a>
    <table id="dataTable" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Tahun Ajaran</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tahunAjarans as $index => $tahunAjaran)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $tahunAjaran->tahun_ajaran }}</td>
          <td>
            <a href="{{ route('editTahunAjaran', $tahunAjaran->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('hapusTahunAjaran', $tahunAjaran->id) }}" method="POST" style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>
@endsection