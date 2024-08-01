@extends('layouts.SiswaTemplate')

@section('content')
<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <h4 class="fw-semibold mb-8">Submit Work for Proyek: {{ $proyek->tema_proyek }}</h4>
    <form action="{{ route('siswa.proyek.submit', $proyek->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="proyek_id" value="{{ $proyek->id }}">
      <div class="form-group">
        <label for="file">Upload File</label>
        <input type="file" class="form-control" id="file" name="file" required>
      </div>
      <div class="form-group">
        <label for="file_link">Link File</label>
        <input type="text" class="form-control" id="file_link" name="file_link" required>
      </div>
      <button type="submit" class="btn btn-primary">Kumpulkan Pekerjaan</button>
    </form>
  </div>
</div>
@endsection