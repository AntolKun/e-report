@extends('layouts.GuruTemplate')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <h4 class="fw-semibold mb-8">Detail Kelas: {{ $class->nama_kelas }}</h4>
    <p>Tahun Ajaran: {{ $class->tahunAjaran->tahun_ajaran }}</p>

    @if($class->proyek->isEmpty())
    <p>Tidak ada proyek untuk kelas ini.</p>
    @else
    <table id="dataProyek" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>Tema Proyek</th>
          <th>Dimensi</th>
          <th>Elemen 1</th>
          <th>Sub Elemen</th>
          <th>Tanggal Deadline</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($class->proyek as $proyek)
        <tr>
          <td>{{ $proyek->tema_proyek }}</td>
          <td>{{ $proyek->dimensi->dimensi }}</td>
          <td>{{ $proyek->elemen_1 }}</td>
          <td>{{ $proyek->sub_elemen }}</td>
          <td>{{ $proyek->tanggal_deadline }}</td>
          <td>
            <a href="{{ route('proyek.show', $proyek->id) }}" class="btn btn-info">Detail</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
</div>
@endsection

<script>
  var detailModal = document.getElementById('modalDetailProyek');
  detailModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var proyekId = button.getAttribute('data-id');

    // Fetch data proyek dan siswa
    fetch(`/proyek/${proyekId}/siswa`)
      .then(response => response.json())
      .then(data => {
        var tbody = document.getElementById('siswaProyekBody');
        tbody.innerHTML = '';

        data.forEach(item => {
          var row = document.createElement('tr');
          row.innerHTML = `
          <td>${item.nama}</td>
          <td>${item.status ? 'Sudah Mengerjakan' : 'Belum Mengerjakan'}</td>
          <td>${item.file_path ? `<a href="${item.file_path}" target="_blank">Lihat File</a>` : item.file_link ? `<a href="${item.file_link}" target="_blank">Lihat Video</a>` : '-'}</td>
          <td><button class="btn btn-info">Lihat</button></td>
        `;
          tbody.appendChild(row);
        });
      });
  });
</script>