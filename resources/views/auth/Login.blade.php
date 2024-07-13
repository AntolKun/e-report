<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 31 Oct 2023 01:42:11 GMT -->

<head>
  <!--  Title -->
  <title>Login | E-Report</title>
  <!--  Required Meta Tag -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="handheldfriendly" content="true" />
  <meta name="MobileOptimized" content="width" />
  <meta name="description" content="Web E-Report" />
  <meta name="author" content="Riski Fummi" />
  <meta name="keywords" content="Web E-Report" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--  Favicon -->
  <link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
  <!-- Core Css -->
  <link id="themeColors" rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100">
      <div class="position-relative z-index-5">
        <div class="row">
          <div class="col-xl-7 col-xxl-8">
            <div class="d-none d-xl-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
              <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/login-security.svg" alt="" class="img-fluid" width="500">
            </div>
          </div>
          <div class="col-xl-5 col-xxl-4">
            <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
              <div class="col-sm-8 col-md-6 col-xl-9">
                <h2 class="mb-3 fs-7 fw-bolder">Selamat Datang</h2>
                <p class=" mb-9">Website E-Report SMAN </p>
                <div class="position-relative text-center my-4">
                  <p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative">Silahkan Login</p>
                  <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                </div>
                <form>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <a href="index.html" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!--  Import Js Files -->
  <script src="{{ asset('dist/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
  <script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!--  core files -->
  <script src="{{ asset('dist/js/app.min.js') }}"></script>
  <script src="{{ asset('dist/js/app.init.js') }}"></script>
  <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
  <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>

  <script src="{{ asset('dist/js/custom.js')}}"></script>
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
</body>

</html>