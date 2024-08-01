@extends('layouts.GuruTemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Data Proyek</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="/">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Data Proyek</li>
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

<div class="row mb-3 justify-content-between">
  <div class="col-auto">
    <form action="{{ route('proyek.index') }}" method="GET">
      <div class="form-group d-flex align-items-center">
        <label for="kelas_id" class="me-2">Pilih Kelas:</label>
        <select name="kelas_id" id="kelas_id" class="form-select" onchange="this.form.submit()">
          <option value="">Semua Kelas</option>
          @foreach($kelas as $kelasItem)
          <option value="{{ $kelasItem->id }}" {{ request('kelas_id') == $kelasItem->id ? 'selected' : '' }}>
            {{ $kelasItem->nama_kelas }}
          </option>
          @endforeach
        </select>
      </div>
    </form>
  </div>
  <div class="col-auto">
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahProyek">
      <i class="fas fa-plus"></i> Tambah Proyek
    </a>
  </div>
</div>

<div class="modal fade" id="modalTambahProyek" tabindex="-1" aria-labelledby="modalTambahProyekLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title" id="modalTambahProyekLabel">Tambah Proyek</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('proyek.store') }}" method="POST">
          @csrf
          <div class="form-group my-4">
            <label for="kelas_id">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-select" required>
              @foreach($kelas as $kelasItem)
              <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group my-4">
            <label for="tema_proyek">Tema Proyek</label>
            <input type="text" name="tema_proyek" class="form-control" id="tema_proyek" required>
          </div>
          <div class="form-group my-4">
            <label for="dimensi_id">Dimensi</label>
            <select name="dimensi_id" id="dimensi_id" class="form-select" required>
              @foreach($dimensi as $dim)
              <option value="{{ $dim->id }}">{{ $dim->dimensi }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group my-4">
            <label for="elemen_1">Elemen 1</label>
            <input type="text" name="elemen_1" class="form-control" id="elemen_1" required>
          </div>
          <div class="form-group my-4">
            <label for="sub_elemen">Sub Elemen</label>
            <input type="text" name="sub_elemen" class="form-control" id="sub_elemen" required>
          </div>
          <div class="form-group my-4">
            <label for="tanggal_deadline">Tanggal Deadline</label>
            <input type="date" name="tanggal_deadline" class="form-control" id="tanggal_deadline" required>
          </div>
          <button type="submit" class="btn btn-success text-black font-medium waves-effect text-start">
            Tambah Proyek
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

<table id="dataProyek" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th>Tema Proyek</th>
      <th>Dimensi</th>
      <th>Elemen 1</th>
      <th>Sub Elemen</th>
      <th>Tanggal Deadline</th>
      <th width="400px">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($proyek as $item)
    <tr>
      <td>{{ $item->tema_proyek }}</td>
      <td>{{ $item->dimensi->dimensi }}</td>
      <td>{{ $item->elemen_1 }}</td>
      <td>{{ $item->sub_elemen }}</td>
      <td>{{ $item->tanggal_deadline }}</td>
      <td>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditProyek" data-id="{{ $item->id }}" data-tema="{{ $item->tema_proyek }}" data-dimensi="{{ $item->dimensi_id }}" data-elemen="{{ $item->elemen_1 }}" data-sub-elemen="{{ $item->sub_elemen }}" data-tanggal="{{ $item->tanggal_deadline }}">
          Edit
        </button>
        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetailProyek" data-id="{{ $item->id }}">
          Detail Proyek
        </button>
        <form action="{{ route('proyek.destroy', $item->id) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="modal fade" id="modalEditProyek" tabindex="-1" aria-labelledby="modalEditProyekLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title" id="modalEditProyekLabel">Edit Proyek</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="editProyekForm">
          @csrf
          @method('PUT')
          <div class="form-group my-4">
            <label for="editKelasId">Kelas</label>
            <select name="kelas_id" id="editKelasId" class="form-select" required>
              @foreach($kelas as $kelasItem)
              <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group my-4">
            <label for="editTemaProyek">Tema Proyek</label>
            <input type="text" name="tema_proyek" class="form-control" id="editTemaProyek" required>
          </div>
          <div class="form-group my-4">
            <label for="editDimensiId">Dimensi</label>
            <select name="dimensi_id" id="editDimensiId" class="form-select" required>
              @foreach($dimensi as $dim)
              <option value="{{ $dim->id }}">{{ $dim->dimensi }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group my-4">
            <label for="editElemen1">Elemen 1</label>
            <input type="text" name="elemen_1" class="form-control" id="editElemen1" required>
          </div>
          <div class="form-group my-4">
            <label for="editSubElemen">Sub Elemen</label>
            <input type="text" name="sub_elemen" class="form-control" id="editSubElemen" required>
          </div>
          <div class="form-group my-4">
            <label for="editTanggalDeadline">Tanggal Deadline</label>
            <input type="date" name="tanggal_deadline" class="form-control" id="editTanggalDeadline" required>
          </div>
          <button type="submit" class="btn btn-success text-black font-medium waves-effect text-start">
            Update Proyek
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

<div class="modal fade" id="modalDetailProyek" tabindex="-1" aria-labelledby="modalDetailProyekLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header d-flex align-items-center">
        <h4 class="modal-title" id="modalDetailProyekLabel">Detail Proyek</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="detailTemaProyek"></p>
        <p id="detailDimensi"></p>
        <p id="detailElemen1"></p>
        <p id="detailSubElemen"></p>
        <p id="detailTanggalDeadline"></p>
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

@section('javascript')
<script src="https://cdn.datatables.net/2.0.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function() {
    $('#dataProyek').DataTable();

    // Modal edit event listener
    $('#modalEditProyek').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id');
      var tema = button.data('tema');
      var dimensi = button.data('dimensi');
      var elemen = button.data('elemen');
      var subElemen = button.data('sub-elemen');
      var tanggal = button.data('tanggal');

      var modal = $(this);
      modal.find('#editTemaProyek').val(tema);
      modal.find('#editDimensiId').val(dimensi);
      modal.find('#editElemen1').val(elemen);
      modal.find('#editSubElemen').val(subElemen);
      modal.find('#editTanggalDeadline').val(tanggal);
      modal.find('#editProyekForm').attr('action', '/proyek/' + id);
    });

    // Modal detail event listener
    $('#modalDetailProyek').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');

      $.ajax({
        url: '/proyek/' + id,
        method: 'GET',
        success: function(data) {
          $('#detailTemaProyek').text('Tema Proyek: ' + data.tema_proyek);
          $('#detailDimensi').text('Dimensi: ' + data.dimensi.dimensi);
          $('#detailElemen1').text('Elemen 1: ' + data.elemen_1);
          $('#detailSubElemen').text('Sub Elemen: ' + data.sub_elemen);
          $('#detailTanggalDeadline').text('Tanggal Deadline: ' + data.tanggal_deadline);
        }
      });
    });
  });
</script>
@endsection