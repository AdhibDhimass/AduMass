@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<link rel="stylesheet" href="path/to/lightbox.css">
<style>
    /* Gaya CSS untuk tombol "Kembali" */
.lightbox-back-button {
    background-color: #007bff; /* Warna latar belakang biru */
    color: #fff; /* Warna teks putih */
    padding: 5px 10px; /* Padding tombol */
    border: none; /* Tanpa border */
    cursor: pointer; /* Kursor berubah menjadi tangan saat mengarahkan ke tombol */
    text-decoration: none; /* Hapus garis bawah default pada tautan */
}

/* Gaya CSS untuk mengubah tampilan tombol saat dihover */
.lightbox-back-button:hover {
    background-color: #0056b3; /* Warna latar belakang biru lebih gelap saat dihover */
}

</style>

@endsection

@section('title', 'Laporan | AduMass')

@section('content')

{{-- Section Header --}}
<section class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <!-- ... kode sebelumnya ... -->
        <div class="collapse navbar-collapse p-2" id="navbarNav ">
            @auth
            @if(auth()->user()->role == 'masyarakat')
            <ul class="navbar-nav text-center ml-auto">
                <li class="nav-item">
                    <a class="nav-link ml-3 text-white" href="/">Home</a>
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
            @endif
            @endauth
        </div>
    </nav>
    <h2 class="text-center p-5 text-white">Laporakan AduanMu</h2>
</section>

{{-- Section Card --}}
<div class="container">
    <div class="row justify-content-between">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 col">
            <div class="content content-top shadow">
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
                        <textarea name="judul" placeholder="Masukkan Judul Laporan" class="form-control"
                            rows="4">{{ old('judul') }}</textarea>
                    </div>
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
        <div class="col-lg-4 col-md-12 col-sm-12 col-12 col">
            <div class="content content-bottom shadow">
                <div>
                    <img src="{{ asset('images/user_default.svg') }}" alt="user profile" class="photo">
                    <div class="self-align">
                        <h5><a style="color: #000" href="#">{{  auth()->user()->nama  }}</a></h5>
                        <p class="text-dark">{{auth()->user()->nama }}</p>
                    </div>
                    <div class="row text-center">
                        <div class="col">
                            <p class="italic mb-0">Terverifikasi</p>
                            <div class="text-center">
                                {{ $hitung[0] }}
                            </div>
                        </div>
                        <div class="col">
                            <p class="italic mb-0">Proses</p>
                            <div class="text-center">
                                {{ $hitung[1] }}
                            </div>
                        </div>
                        <div class="col">
                            <p class="italic mb-0">Selesai</p>
                            <div class="text-center">
                                {{ $hitung[2] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 mt-5">
        <a class="d-inline tab {{ $siapa != 'me' ? 'tab-active' : ''}}" href="{{ route('pekat.laporan') }}">
            Semua
        </a>
        @if(auth()->user()->role == 'masyarakat')
        <a class="d-inline tab {{ $siapa == 'me' ? 'tab-active' : ''}}" href="{{ route('pekat.laporan', 'me') }}">
            Laporan Saya
        </a>
        @endif
        <hr>
    </div>

        @foreach ($pengaduan as $k => $v)
        <div class="col-lg-8">
            <div class="laporan-top">
                <img src="{{ asset('images/user_default.svg') }}" alt="profile" class="profile">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="font-bold">{{ $v->user ? $v->user->nama : 'User Tidak Ditemukan' }}</p>
                        @if ($v->status == '0')
                        <p class=" badge badge-danger text-white p-1">Pending</p>
                        @elseif($v->status == 'proses')
                        <p class="badge badge-warning text-white p-1">{{ ucwords($v->status) }}</p>
                        @else
                        <p class="badge badge-success text-white p-1">{{ ucwords($v->status) }}</p>
                        @endif
                    </div>
                    <div>
                        <p>{{ $v->created_at->format('d M, h:i') }}</p>
                    </div>
                </div>
            </div>
            <div class="laporan-mid">
                <div class="judul-laporan">
                    {{ $v->judul }}
                </div>
                <p>{{ $v->isi_laporan }}</p>
            </div>
            <div class="laporan-bottom">
                <div class="laporan-bottom">
                    @if ($v->foto != null)
                    <a href="{{ Storage::url($v->foto) }}" data-lightbox="gambar-laporan" data-title="{{ 'Gambar '.$v->judul }}">
                        <img src="{{ Storage::url($v->foto) }}" alt="{{ 'Gambar '.$v->judul }}" class="gambar-lampiran" style="max-width: 100%; height: auto;">
                        <button id="backButton" class="lightbox-back-button" style="display: none;">Kembali</button>
                    </a>
                    @endif
                </div>


                @php
                $latestTanggapan = $v->tanggapan()->latest()->first(); // Mengambil tanggapan terbaru
                @endphp

                @if ($latestTanggapan)
                <p class="mt-3 mb-1">{{ 'Ditanggapi oleh '. $latestTanggapan->user->nama}}</p>
                <p class="light">{{ $latestTanggapan->tanggapan }}</p>
                <p class="light">{{ 'Waktu Tanggapan: '. $latestTanggapan->created_at->format('d F Y, H:i:s') }}</p>
                @endif
            </div>


            <hr>
        </div>
        @endforeach
    </div>
</div>
{{-- Footer --}}
<div class="mt-5">
    <hr>
    <div class="text-center">
        <p class="italic text-secondary">© adhibdhimas • All rights reserved</p>
    </div>
</div>
@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script src="path/to/lightbox.js"></script>
<script>
// Fungsi untuk menampilkan lightbox
function openLightbox(imageUrl) {
    // Mendapatkan elemen lightbox dan tombol "Kembali"
    var lightbox = document.getElementById('lightbox');
    var backButton = document.getElementById('backButton');

    // Mendapatkan elemen gambar lightbox
    var lightboxImage = lightbox.querySelector('img');

    // Mengatur URL gambar lightbox sesuai dengan imageUrl
    lightboxImage.src = imageUrl;

    // Menampilkan lightbox
    lightbox.style.display = 'block';

    // Menampilkan tombol "Kembali"
    backButton.style.display = 'block';

    // Mengatur tindakan saat gambar lightbox diklik
    lightboxImage.addEventListener('click', function() {
        // Mengarahkan ke halaman laporan ketika gambar lightbox diklik
        window.location.href = "{{ route('pekat.laporan') }}";
    });

    // Mengatur tindakan saat tombol "Kembali" diklik
    backButton.addEventListener('click', function() {
        // Menyembunyikan lightbox dan tombol "Kembali" ketika tombol "Kembali" diklik
        lightbox.style.display = 'none';
        backButton.style.display = 'none';
    });
}

</script>


@endif
@endsection
