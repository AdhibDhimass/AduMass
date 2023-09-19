@extends('layouts.master')

@section('sub-title')

@endsection

@section('css')

@endsection

@section('title')

@endsection

@section('content')
<div class="row">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">Form Tambah Prtugas</div>
            <div class="card-body">
                <form action="/petugas/{{ $petugas->id }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik" disabled value="{{ $petugas->nik }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Petugas</label>
                        <input type="text" name="nama" id="nama" value="{{ $petugas->nama }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" disabled value="{{ $petugas->email }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="telp">Telp</label>
                        <input type="text" name="telp" id="telp" value="{{ $petugas->telp }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <select class="custom-select" name="role" id="role">
                            <option value="admin" {{ old('role', $petugas->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="petugas" {{ old('role', $petugas->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="text-center">
    <a href="{{ route('pengaduan.index') }}" class="mx-auto flex">
        <button type="submit" class="btn btn-outline-secondary">Kembali</button>
    </a>
</div>
@endsection
