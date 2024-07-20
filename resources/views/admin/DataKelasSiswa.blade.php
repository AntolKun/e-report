@extends('layouts.UserTemplate')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
@endsection

@section('content')

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Assignment Kelas: {{ $kelas->nama_kelas }}</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dataKelas') }}">Kelas</a></li>
            <li class="breadcrumb-item" aria-current="page">Assignment</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

@if ($message = session()->get('success'))
<div class="alert alert-success">
  {{ $message }}
</div>
@endif

@if ($message = session()->get('error'))
<div class="alert alert-danger">
  {{ $message }}
</div>
@endif

<div>
  <h5>Guru: {{ $kelas->guru->nama }}</h5>
  <h5>Tahun Ajaran: {{ $kelas->tahunAjaran->tahun_ajaran }}</h5>
</div>

<form action="{{ route('simpanKelasSiswa', $kelas->id) }}" method="POST">
  @csrf
  <div class="row">
    <div class="col-md-6 my-4">
      <div>
        <strong>Pilih Siswa:</strong>
        <select class="form-control" name="siswa_id" {{ $siswas->isEmpty() ? 'disabled' : '' }}>
          @if($siswas->isEmpty())
          <option value="">Semua siswa sudah masuk kelas</option>
          @else
          @foreach ($siswas as $siswa)
          <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
          @endforeach
          @endif
        </select>
      </div>
    </div>
    <div>
      <button type="submit" class="mt-4 btn btn-rounded btn-success text-black" {{ $siswas->isEmpty() ? 'disabled' : '' }}>Tambahkan Siswa</button>
    </div>
  </div>
</form>

<h4 class="mt-5">Daftar Siswa di Kelas</h4>

<table id="datakelassiswa" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Siswa</th>
      <th>NISN</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($assignedSiswas as $index => $assigned)
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $assigned->siswa->nama }}</td>
      <td>{{ $assigned->siswa->nisn }}</td>
      <td>
        <button class="btn btn-danger" onclick="confirmDelete('{{ $assigned->id }}')">Delete</button>
        <form id="delete-form-{{ $assigned->id }}" action="{{ route('hapusKelasSiswa', [$kelas->id, $assigned->id]) }}" method="POST" style="display: none;">
          @csrf
          @method('DELETE')
        </form>
        <!-- <form action="{{ route('hapusKelasSiswa', [$kelas->id, $assigned->id]) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form> -->
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
    $('#datakelassiswa').DataTable();
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
  function confirmDelete(id) {
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
        document.getElementById('delete-form-' + id).submit();
      }
    })
  }
</script>


@endsection