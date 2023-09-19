@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('title')
Masyarakat
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    new DataTable('#example');
</script>
@endsection

@section('content')
<div class="table-responsive">
    <table class="table">
        <thead class="thead-dark" style="color: ">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nik</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Telp</th>
                <th scope="col">Detail</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($masyarakat as $k => $v)
            <tr>
                <th scope="row">{{ $k + 1 }}</th>
                <td>{{ $v->nik }}</td>
                <td>{{ $v->nama }}</td>
                <td>{{ $v->email }}</td>
                <td>{{ $v->telp }}</td>
                <td>{{$v->role}}</td>
                <td>
                    <a href="/masyarakat/{{ $v->id }}/edit" class="btn btn-primary"><i class="fa-solid fa-edit"></i></a>
                    <form action="/masyarakat/{{ $v->id }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus user ini?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
