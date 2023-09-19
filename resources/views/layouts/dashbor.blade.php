<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"/>
    <link rel="stylesheet" href="path/to/sweetalert2.min.css">
    <style>
        .sidebar-brand .sidebar-brand-icon img {
    width: 100px; /* Sesuaikan dengan ukuran yang Anda inginkan */
    height: 50px; /* Sesuaikan dengan ukuran yang Anda inginkan */
}
    </style>


    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon ">
              <img src="/images/adumas.png" alt="">
            </div>
          </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
        <!-- Heading -->
        {{-- <div class="sidebar-heading">Addons</div> --}}

        <!-- Nav Item - Pages Collapse Menu -->
        {{-- <li class="nav-item active">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages" >
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
          </a>
          <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Login Screens:</h6>
              <a class="collapse-item" href="login.html">Login</a>
              <a class="collapse-item" href="register.html">Register</a>
              <a class="collapse-item" href="forgot-password.html"
                >Forgot Password</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Other Pages:</h6>
              <a class="collapse-item" href="404.html">404 Page</a>
              <a class="collapse-item active" href="blank.html">Blank Page</a>
            </div>
          </div>
        </li> --}}

        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="{{route('pengaduan.index')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Pengaduan</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('masyarakat.index') }}">
            <i class="fa-solid fa-users"></i>
            <span>Masyarakat</span></a>
        </li>

        @if (auth()->user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('petugas.index') }}">
                <i class="fa-solid fa-user-group"></i>
                <span>Petugas</span></a>
            </li>
        @endif

        <li class="nav-item">
          <a class="nav-link" href="{{ route('laporan.index') }}">
            <i class="fa-solid fa-newspaper"></i>
            <span>Laporan</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" >
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" >
              <i class="fa fa-bars"></i>
            </button>

           <div class="p-5">
              <a href="/" class="text-center">Home</a>
           </div>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
                </a>
              </li>

              <!-- Nav Item - Alerts -->


              <!-- Nav Item - Messages -->


              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- nama,logout -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->nama }}</span>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i
                      class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                    ></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('sub-title')</h1>
          </div>
          <!-- /.container-fluid -->
        <!-- Content Row -->
        <div class="row p-3">
            @yield('content')
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Masyarakat</div>
                                @php
                                    $masyarakat = \App\Models\User::where('role', 'masyarakat')->count();
                                @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $masyarakat }}</div>
                            </div>
                            <div class="col-auto">
                                {{-- <i class="fas fa-user fa-2x text-gray-300"></i> --}}
                                <i class="fa-solid fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Petugas</div>
                                @php
                                    $petugas = \App\Models\User::where('role', 'petugas')->count();
                                @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $petugas }}</div>
                            </div>
                            <div class="col-auto">
                                {{-- <i class="fa-user-group fa-2x text-gray-300"></i> --}}
                                <i class="fa-solid fa-user-group fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Admin
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                @php
                                    $admin = \App\Models\User::where('role', 'admin')->count();
                                @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $admin }}</div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Laporan pending</div>
                                @php
                                    $pending = \App\Models\Pengaduan::where('status', '0')->count();
                                @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pending }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Laporan proses</div>
                                @php
                                    $proses = \App\Models\Pengaduan::where('status', 'proses')->count();
                                @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $proses }}</div>
                            </div>
                            <div class="col-auto">
                                {{-- <i class="fas fa-comments fa-2x text-gray-300"></i> --}}
                                <i class="fa-solid fa-arrows-rotate  fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Laporan selesai</div>
                                @php
                                    $selesai = \App\Models\Pengaduan::where('status', 'selesai')->count();
                                @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $selesai }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; adhibdhimas</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Select "Logout" below if you are ready to end your current session.
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary"type="button"data-dismiss="modal">
              Cancel
            </button>
            <a class="btn btn-danger"
            type="button"
            data-dismiss="modal" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    {{-- fontawsn --}}
    <script src="https://kit.fontawesome.com/61bcac0926.js" crossorigin="anonymous"></script>

    <script src="path/to/sweetalert2.all.min.js"></script>
    <script>
        function logoutWithNotification() {
           // Lakukan logout dengan mengirimkan form
           document.getElementById('logout-form').submit();

           // Tampilkan notifikasi setelah logout berhasil
           Swal.fire({
              title: 'Logout Successful',
              text: 'You have been logged out.',
              icon: 'success',
           });
        }
     </script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
  </body>
</html>
