@extends('layouts.UserTemplate')
@section('content')
<div class="row">
  <div class="col-sm-6 col-xl-3">
    <div class="card bg-light-primary shadow-none">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div class="round rounded bg-primary d-flex align-items-center justify-content-center">
            <i class="cc BTC text-white fs-7" title="BTC"></i>
          </div>
          <h6 class="mb-0 ms-3">BTC</h6>
          <div class="ms-auto text-primary d-flex align-items-center">
            <i class="ti ti-trending-up text-primary fs-6 me-1"></i>
            <span class="fs-2 fw-bold">+ 2.30%</span>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-4">
          <h3 class="mb-0 fw-semibold fs-7">0.1245</h3>
          <span class="fw-bold">$1,015.00</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card bg-light-danger shadow-none">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div class="round rounded bg-danger d-flex align-items-center justify-content-center">
            <i class="cc ETH text-white fs-7" title="ETH"></i>
          </div>
          <h6 class="mb-0 ms-3">ETH</h6>
          <div class="ms-auto text-danger d-flex align-items-center">
            <i class="ti ti-trending-up text-danger fs-6 me-1"></i>
            <span class="fs-2 fw-bold">+ 3.20%</span>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-4">
          <h3 class="mb-0 fw-semibold fs-7">0.5620</h3>
          <span class="fw-bold">$2,110.00</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card bg-light-success shadow-none">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div class="round rounded bg-success d-flex align-items-center justify-content-center">
            <i class="cc LTC text-white fs-7" title="LTC"></i>
          </div>
          <h6 class="mb-0 ms-3">LTC</h6>
          <div class="ms-auto text-info d-flex align-items-center">
            <i class="ti ti-trending-down text-success fs-6 me-1"></i>
            <span class="fs-2 fw-bold text-success">+ 3.20%</span>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-4">
          <h3 class="mb-0 fw-semibold fs-7">1.200</h3>
          <span class="fw-bold">$1,100.00</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card bg-light-warning shadow-none">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div class="round rounded bg-warning d-flex align-items-center justify-content-center">
            <i class="cc XRP text-white fs-7" title="XRP"></i>
          </div>
          <h6 class="mb-0 ms-3">XRP</h6>
          <div class="ms-auto text-info d-flex align-items-center">
            <i class="ti ti-trending-down text-warning fs-6 me-1"></i>
            <span class="fs-2 fw-bold text-warning">+ 2.20%</span>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-4">
          <h3 class="mb-0 fw-semibold fs-7">1.150</h3>
          <span class="fw-bold">$2,150.00</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection