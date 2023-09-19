@extends('layouts.master')

@section('sub-title')

@endsection

@section('css')

@endsection

@section('title')

@endsection

@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif


<div class="row">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">Form Tambah Prtugas</div>
            <div class="card-body">
                <form action="/masyarakat/{{ $masyarakat->id }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik" disabled value="{{ $masyarakat->nik }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama masyarakat</label>
                        <input type="text" name="nama" id="nama" value="{{ $masyarakat->nama }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" disabled value="{{ $masyarakat->email }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="telp">Telp</label>
                        <input type="text" name="telp" id="telp" value="{{ $masyarakat->telp }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
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
