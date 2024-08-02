@extends('layouts.SiswaTemplate')

@section('content')
<h1>Warning</h1>
<h5>Untuk pengiriman file PDF, RAR, dan ZIP, menggunakan Google Drive, lalu kirimkan ke kolom link!</h5>
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <h4 class="fw-semibold mb-8">Submit Work for Proyek: {{ $proyek->tema_proyek }}</h4>
    <form action="{{ route('siswa.proyek.submit.post', $proyek->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="proyek_id" value="{{ $proyek->id }}">
      <div class="form-group">
        <label for="file">Upload File</label>
        <input type="file" class="form-control" id="file" name="file">
      </div>
      <div class="form-group">
        <label for="file_link">Link File</label>
        <input type="text" class="form-control" id="file_link" name="file_link">
      </div>
      <button type="submit" class="btn btn-primary mt-4">Kumpulkan Pekerjaan</button>
    </form>
  </div>
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