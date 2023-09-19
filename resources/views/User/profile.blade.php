{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="row justify-content-center">
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
    </div>
</body>
</html> --}}

@extends('layouts.app') <!-- Sesuaikan dengan layout yang Anda gunakan -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- NIK -->
                        <div class="form-group row">
                            <label for="nik" class="col-md-4 col-form-label text-md-right">NIK</label>
                            <div class="col-md-6">
                                <input id="nik" type="text" class="form-control" name="nik" value="{{ $user->nik }}" disabled>
                            </div>
                        </div>

                        <!-- Nama -->
                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ $user->nama }}" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                        <!-- Telp -->
                        <div class="form-group row">
                            <label for="telp" class="col-md-4 col-form-label text-md-right">Telp</label>
                            <div class="col-md-6">
                                <input id="telp" type="text" class="form-control" name="telp" value="{{ $user->telp }}" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('profile.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


