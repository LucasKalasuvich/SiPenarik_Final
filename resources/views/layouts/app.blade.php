<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Signaty - @yield('title')</title>
  <link rel="shortcut icon" href="{{ asset('img/signn.png') }}">
  

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <link rel="stylesheet" href="{{ asset('css/card.css') }}">
  @guest
  @else
    @if (Auth::user()->level != 'Admin')
      <style>
        .navbar a.title {
          color: #fff;
          height: 5rem;
          text-decoration: none;
          font-size: 1.5rem;
          font-weight: 800;
          padding: 1.5rem 1rem;
          text-align: center;
          text-transform: uppercase;
          letter-spacing: .05rem;
          z-index: 1;
          align-items: center;
          justify-content: center;
          display: flex;
          background-image: url("wave.jpg")
        }

        .navbar a.title .title-text {
          display: inline;
        }
      </style>
    @endif
  @endguest

  @yield('styles')
</head>
<body id="page-top">
  @guest
    <div class="container-fluid">
      <!-- Outer Row -->
      <div class="row justify-content-center">
        @yield('content')
      </div>
    </div>
  @else
    @if (Auth::user()->level == 'Admin' || 'Users')
      <!-- Page Wrapper -->
      <div id="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
          <!-- Main Content -->
          <div id="content">
            <!-- Navbar -->
            @include('layouts.navbar')
            <!-- End of Navbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
              <!-- Page Heading -->
              <h1 class="h3 mb-4 text-gray-800">@yield('heading')</h1>
              <!-- Content -->
              @yield('content')
            </div>
            <!-- /.container-fluid -->
          </div>
          <!-- End of Main Content -->
          <!-- Footer -->
          <footer class="sticky-footer ">
            <div class="container-fluid my-auto d-flex justify-content-end">
              <div class="copyright text-center my-auto">
                <span>
                  Copyright &copy; 2022
                  @if (date('Y') != '2022')
                    - {{ date('Y') }}
                  @endif
                  &nbsp; PUSTEKINFO
                  
                </span>
              </div>
            </div>
          </footer>
          <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
    @endif
  @endguest

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

  @yield('script')

  @if (count($errors)>0)
    @foreach ($errors->all() as $error)
      <script>
        toastr.error("{{ $error }}");
      </script>
    @endforeach
  @endif
  @if (Session::has('success'))
    <script>
      toastr.success("{{ Session('success') }}");
    </script>
  @endif
  @if (Session::has('error'))
    <script>
      toastr.error("{{ Session('error') }}");
    </script>
  @endif
</body>
</html>
