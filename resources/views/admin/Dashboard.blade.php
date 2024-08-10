@extends('layouts.UserTemplate')
@section('content')
<div class="row">
  <div class="col-sm-6 col-xl-3">
    <div class="card bg-light-primary shadow-none">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div class="round rounded bg-primary d-flex align-items-center justify-content-center">
            <i class="ti ti-school text-white fs-7" title="Guru"></i>
          </div>
          <h6 class="mb-0 ms-3">Guru</h6>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-4">
          <h3 class="mb-0 fw-semibold fs-7">{{ $guru > 0 ? $guru : 'Belum ada guru' }}</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card bg-light-danger shadow-none">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div class="round rounded bg-danger d-flex align-items-center justify-content-center">
            <i class="ti ti-backpack text-white fs-7" title="Siswa"></i>
          </div>
          <h6 class="mb-0 ms-3">Siswa</h6>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-4">
          <h3 class="mb-0 fw-semibold fs-7">{{ $siswa > 0 ? $siswa : 'Belum ada Siswa' }}</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card bg-light-success shadow-none">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div class="round rounded bg-success d-flex align-items-center justify-content-center">
            <i class="ti ti-user-exclamation text-white fs-7" title="Admin"></i>
          </div>
          <h6 class="mb-0 ms-3">Admin</h6>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-4">
          <h3 class="mb-0 fw-semibold fs-7">{{ $admin > 0 ? $admin : 'Belum ada Admin' }}</h3>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection