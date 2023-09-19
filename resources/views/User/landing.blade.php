@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="path/ke/style.css">
@endsection

@section('title', 'AduMass - Aduan Masyarakat')

@section('content')
{{-- Section Header --}}
<section class="header" style="height: 600px">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/adumas.png" alt="" style="width: 120px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(auth()->user())
                    <ul class="navbar-nav text-center ml-auto">
                    @auth
                    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')
                    <li class="nav-item">
                        <a class="nav-link ml-3 text-white" href="/dashboard">Dashboard</a>
                    </li>
                @endif

                    @endauth
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="{{ route('pekat.laporan') }}">Laporan</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->nama }}
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                    @else
                        <!-- Tampilkan konten untuk pengguna yang belum login -->
                        <ul class="navbar-nav text-center ml-auto">
                            <li class="nav-item">
                                <a class="btn text-white" class="btn btn-primary"
                                    href="/login">Masuk</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register" class="btn btn-outline-purple">Daftar</a>
                            </li>
                        </ul>
                    @endauth

                </div>
            </div>
        </div>
    </nav>

    {{-- <div class="text-center">
        <h2 class="medium text-white mt-3">Layanan Aduan Masyarakat</h2>
        <p class="italic text-white mb-5">Sampaikan laporan Anda langsung kepada yang pemerintah berwenang</p>
    </div> --}}

    <div class="container p-5">
      <div class="row">
          <div class="col-lg-8">
              <div class="text-container" style="margin-bottom: -70px;">
                  <h1 class="h1-large text-white">Layanan Aduan Masyarakat</h1>
                  <p class="p-large text-white">
                      Sampaikan laporan Anda langsung kepada <br>
                      pemerintah yang berwenang
                  </p>
                  <a href="/laporann" class="btn btn-primary btn-lg" style="border-radius: 50px;">Laporkan</a>
              </div>
          </div>
          <div class="col-lg-4">
            <div class="image-container d-flex justify-content-center align-items-center" style="height: 70%;">
                <img class="img-fluid" src="/images/tangan.png" alt="alternative">
            </div>
        </div>

      </div>
  </div>



    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>
{{-- Section Card Pengaduan --}}
{{-- <div class="row justify-content-center">
    <div class="col-lg-6 col-10 col">
        <div class="content shadow">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            @if (Session::has('pengaduan'))
                <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
            @endif

            <div class="card mb-3">Tulis Laporan Disini</div>
            <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                        rows="4">{{ old('isi_laporan') }}</textarea>
                </div>
                <div class="form-group">
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-custom mt-2">Kirim</button>
            </form>
        </div>
    </div>
</div> --}}

 <h1 class="text-center"></h1>
<div class="container py-5">
    <div class="row">
      <!-- Column -->
      <div class="col-md-6 col-lg-3 mb-4">
        <!-- Article -->
        <article class="card shadow-lg bg-secondary text-white">
          <img alt="Tulis"
            class="card-img-top mx-auto my-4 img-fluid "
            style="min-width: 150px; max-width: 150px; "
            src="/images/list (1).png"  />
          <div class="card-body text-center">
            <h1 class="card-title h4 font-weight-bold">1. Tulis Laporan</h1>
            <p class="card-text py-2">
              Laporkan keluhan atau aspirasi Anda dengan jelas dan lengkap.
            </p>
          </div>
        </article>
        <!-- END Article -->
      </div>
      <!-- END Column -->

      <!-- Repeat the above structure for other columns (2. Proses Verifikasi, 3. Tindak Lanjut, 4. Selesai) -->
      <!-- Column -->
      <div class="col-md-6 col-lg-3 mb-4">
        <!-- Article -->
        <article class="card shadow-lg bg-secondary text-white">
          <img alt="Proses"
            class="card-img-top mx-auto my-4 img-fluid"
            style="min-width: 150px; max-width: 150px;"
            src="/images/refresh.png" />
          <div class="card-body text-center">
            <h1 class="card-title h4 font-weight-bold">2. Proses Verifikasi</h1>
            <p class="card-text py-2">
              Laporan Anda akan diverifikasi.
            </p>
          </div>
        </article>
        <!-- END Article -->
      </div>
      <!-- END Column -->

      <!-- Column -->
      <div class="col-md-6 col-lg-3 mb-4">
        <!-- Article -->
        <article class="card shadow-lg bg-secondary text-white">
          <img alt="Ditindak"
            class="card-img-top mx-auto my-4 img-fluid"
            style="min-width: 150px; max-width: 150px;"
            src="/images/process (1).png" />
          <div class="card-body text-center">
            <h1 class="card-title h4 font-weight-bold">3. Tindak Lanjut</h1>
            <p class="card-text py-2">
              Instansi akan menindaklanjuti dan membalas laporan Anda.
            </p>
          </div>
        </article>
        <!-- END Article -->
      </div>
      <!-- END Column -->

      <!-- Column -->
      <div class="col-md-6 col-lg-3 mb-4">
        <!-- Article -->
        <article class="card shadow-lg bg-secondary text-white">
          <img alt="Selesai"
            class="card-img-top mx-auto my-4 img-fluid"
            style="min-width: 150px; max-width: 150px;"
            src="/images/checked.png" />
          <div class="card-body text-center">
            <h1 class="card-title h4 font-weight-bold">4. Selesai</h1>
            <p class="card-text py-2">
              Laporan Anda akan terus ditindaklanjuti hingga terselesaikan.
            </p>
          </div>
        </article>
        <!-- END Article -->
      </div>
      <!-- END Column -->
    </div>
  </div>


{{-- Section Hitung Pengaduan --}}
<div class="pengaduan mt-5">
    <div class="bg-purple">
        <div class="text-center">
            <h5 class="medium text-white mt-3">JUMLAH LAPORAN SEKARANG</h5>
            <h2 class="medium text-white">{{ $jumlahLaporan }}</h2>
        </div>
    </div>
</div>

{{-- Footer --}}
<div class="mt-5">
    <hr>
    <div class="text-center">
        <p class="italic text-secondary">© adhibdhimas • All rights reserved</p>
    </div>
</div>
{{-- Modal --}}
{{-- <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="mt-3">Masuk terlebih dahulu</h3>
                <p>Silahkan masuk menggunakan akun yang sudah didaftarkan.</p>
                <form action="/login" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-purple text-white mt-3" style="width: 100%">MASUK</button>
                </form>
                @if (Session::has('pesan'))
                <div class="alert alert-danger mt-2">
                    {{ Session::get('pesan') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('js')
    @if (Session::has('pesan'))
    <script>
        $('#loginModal').modal('show');
    </script>
    @endif
    <script src="https://kit.fontawesome.com/61bcac0926.js" crossorigin="anonymous"></script>
@endsection
