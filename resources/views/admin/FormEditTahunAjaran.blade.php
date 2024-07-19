@extends('layouts.UserTemplate')

@section('content')

<div class="card bg-light-info shadow-none position-relative overflow-hidden">
  <div class="card-body px-4 py-3">
    <div class="row align-items-center">
      <div class="col-9">
        <h4 class="fw-semibold mb-8">Edit Tahun Ajaran</h4>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="/adminDashboard">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Edit Tahun Ajaran</li>
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

@if ($errors->any())
<div>
  <strong>Error!</strong> There were some problems with your input.<br><br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('updateTahunAjaran', $tahunAjaran->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-md-12 my-4">
      <div>
        <strong>Tahun Ajaran:</strong>
        <input type="text" class="form-control" name="tahun_ajaran" value="{{ old('tahun_ajaran', $tahunAjaran->tahun_ajaran) }}">
      </div>
    </div>
    <div>
      <button type="submit" class="mt-4 btn btn-rounded btn-success text-black">Perbarui Tahun Ajaran</button>
    </div>
  </div>
</form>

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
    title: 'Waduh!',
    text: '{{ $message }}',
  })
</script>
@endif
@endsection