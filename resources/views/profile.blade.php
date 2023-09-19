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
