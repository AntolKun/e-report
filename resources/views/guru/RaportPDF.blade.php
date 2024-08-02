<!DOCTYPE html>
<html>

<head>
  <title>Raport Proyek</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <h2 class="text-center">Laporan Kegiatan Projek Penguatan Profil Pelajar Pancasila</h2>
  <h4>Topik: {{ $proyek->tema_proyek }}</h4>
  <p><strong>Dimensi:</strong> {{ $proyek->dimensi->dimensi }}</p>
  <p><strong>Elemen 1:</strong> {{ $proyek->elemen_1 }}</p>
  <p><strong>Sub Elemen:</strong> {{ $proyek->sub_elemen }}</p>
  <p><strong>Tanggal Deadline:</strong> {{ $proyek->tanggal_deadline }}</p>
  <p><strong>Kelas:</strong> {{ $proyek->kelas->nama_kelas }}</p>

  <h3>Detail Siswa</h3>
  <table>
    <thead>
      <tr>
        <th>Nama Siswa</th>
        <th>Status</th>
        <th>Link File</th>
        <th>File</th>
        <th>Tanggal Submit</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $item)
      <tr>
        <td>{{ $item['nama'] }}</td>
        <td>{{ $item['status'] }}</td>
        <td>{{ $item['file_link'] }}</td>
        <td>{{ $item['file_path'] }}</td>
        <td>{{ $item['tanggal_submit'] }}</td>
        <td>{{ $item['keterangan'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>