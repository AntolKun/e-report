@extends('layouts.GuruTemplate')

@section('content')
<div class="container">
  <h1>Detail Proyek</h1>
  <h2>{{ $proyek->tema_proyek }}</h2>
  <p><strong>Dimensi:</strong> {{ $proyek->dimensi->dimensi }}</p>
  <p><strong>Elemen 1:</strong> {{ $proyek->elemen_1 }}</p>
  <p><strong>Sub Elemen:</strong> {{ $proyek->sub_elemen }}</p>
  <p><strong>Tanggal Deadline:</strong> {{ $proyek->tanggal_deadline }}</p>

  <h3>Status Pengerjaan Siswa</h3>
  <table class="table">
    <thead>
      <tr>
        <th>Nama Siswa</th>
        <th>Status</th>
        <th>Link File</th>
        <th>File</th>
        <th>Keterangan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($proyek->proyekSiswa as $ps)
      <tr>
        <td>{{ $ps->siswa->nama }}</td>
        <td>
          @if($ps->status)
          <span class="badge bg-success">Sudah Mengerjakan</span>
          @else
          <span class="badge bg-danger">Belum Mengerjakan</span>
          @endif
        </td>
        <td>
          @if($ps->file_link)
          <a href="{{ $ps->file_link }}" target="_blank">Lihat File</a>
          @else
          -
          @endif
        </td>
        <td>
          @if($ps->file_path)
          <a href="{{ route('guru.proyek.download', ['id' => $proyek->id, 'fileName' => basename($ps->file_path)]) }}">
            Download File
          </a>
          @else
          -
          @endif
        </td>
        <td>{{ $ps->keterangan }}</td>
        <td>
          <!-- Tombol untuk membuka modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#keteranganModal{{ $ps->id }}">
            Tambah Keterangan
          </button>

          <!-- Modal -->
          <div class="modal fade" id="keteranganModal{{ $ps->id }}" tabindex="-1" aria-labelledby="keteranganModalLabel{{ $ps->id }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="keteranganModalLabel{{ $ps->id }}">Tambah Keterangan untuk {{ $ps->siswa->nama }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guru.proyek.saveKeterangan', $proyek->id) }}" method="POST">
                  @csrf
                  <div class="modal-body">
                    <input type="hidden" name="siswa_id" value="{{ $ps->siswa->id }}">
                    <div class="mb-3">
                      <label for="keterangan" class="form-label">Keterangan</label>
                      <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required>{{ $ps->keterangan }}</textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
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
    title: 'Alamak!',
    text: '{{ $message }}',
  })
</script>
@endif
@endsection