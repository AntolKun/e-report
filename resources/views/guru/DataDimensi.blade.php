@extends('layouts.GuruTemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Data Dimensi</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="/">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Data Dimensi</li>
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
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahDimensi">
      <i class="fas fa-plus"></i> Tambah Dimensi
    </a>
  </div>
</div>

<div class="modal fade" id="modalTambahDimensi" tabindex="-1" aria-labelledby="modalTambahDimensiLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title" id="modalTambahDimensiLabel">Tambah Dimensi</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('dimensi.store') }}" method="POST">
          @csrf
          <div class="form-group my-4">
            <label for="dimensi">Dimensi</label>
            <input type="text" name="dimensi" class="form-control" id="dimensi" required>
          </div>
          <button type="submit" class="btn btn-success text-black font-medium waves-effect text-start">
            Tambah Dimensi
          </button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect text-start" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

<table id="dataDimensi" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th>Dimensi</th>
      <th width="400px">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dimensi as $item)
    <tr>
      <td>{{ $item->dimensi }}</td>
      <td>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditDimensi" data-id="{{ $item->id }}" data-dimensi="{{ $item->dimensi }}">
          Edit
        </button>
        <form action="{{ route('dimensi.destroy', $item->id) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="modal fade" id="modalEditDimensi" tabindex="-1" aria-labelledby="modalEditDimensiLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title" id="modalEditDimensiLabel">Edit Dimensi</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="editDimensiForm">
          @csrf
          @method('PUT')
          <div class="form-group my-4">
            <label for="editDimensi">Dimensi</label>
            <input type="text" name="dimensi" class="form-control" id="editDimensi" required>
          </div>
          <button type="submit" class="btn btn-light-success text-success font-medium waves-effect text-start">
            Update Dimensi
          </button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect text-start" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
  $(document).ready(function() {
    $('#dataDimensi').DataTable();
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
  // Set up modal with dimensi data
  document.addEventListener('DOMContentLoaded', function() {
    var editModal = document.getElementById('modalEditDimensi');
    editModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget;
      var dimensiId = button.getAttribute('data-id');
      var dimensi = button.getAttribute('data-dimensi');

      var form = editModal.querySelector('form');
      form.action = '{{ route("dimensi.update", ":id") }}'.replace(':id', dimensiId);
      form.querySelector('#editDimensi').value = dimensi;
    });
  });
</script>
@endsection