@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('title')
Petugas
@endsection

@section('js')
<script>
    // Tampilkan notifikasi jika ada
    @if (Session::has('status'))
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('notification').style.display = 'block';
        document.getElementById('notification').innerText = '{{ Session::get('status') }}';

        // Hilangkan notifikasi setelah 3 detik
        setTimeout(function () {
            document.getElementById('notification').style.display = 'none';
        }, 3000);
    });
    @endif
</script>
@endsection

@section('content')
@if (Session::has('status'))
<div class="alert alert-success mt-2" id="notification">
    {{ Session::get('status') }}
</div>
@endif
<a href="{{route('petugas.create')}}" class="btn btn-success">+ Tambah Petugas</a>

<div class="table-responsive p-2">
    <table class="table">
        <thead class="thead-dark" style="color: ">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nik</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Telp</th>
                <th scope="col">Level</th>
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($petugas as $k => $v)
            <tr>
                <th scope="row">{{ $k + 1 }}</th>
                <td>{{ $v->nik }}</td>
                <td>{{ $v->nama }}</td>
                <td>{{ $v->email }}</td>
                <td>{{ $v->telp }}</td>
                <td>{{$v->role}}</td>
                <td>
                    <a href="/petugas/{{ $v->id }}/edit" class="btn btn-primary"><i class="fa-solid fa-edit"></i></a>
                    <form action="/petugas/{{ $v->id }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus produk ini?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>




@endsection
