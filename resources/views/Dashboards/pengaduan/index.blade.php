@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('title')
Pengaduan
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    new DataTable('#example');
</script>
@endsection

@section('content')


<div id="notification-container">
    @if (Session::has('status'))
    <div class="alert alert-success mt-2" id="notification">
        {{ Session::get('status') }}
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('notification').style.display = 'none';
        }, 3000); // Notifikasi akan menghilang setelah 3 detik
    </script>
    @endif
</div>

<div class="table-responsive">
    <table class="table">
        <thead class="thead-dark" style="color: ">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Foto</th>
                <th scope="col">Nama</th>
                <th scope="col">Judul</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $k => $v)
            <tr>
                <th scope="row">{{ $k + 1 }}</th>
                <td>
                    @if ($v->foto)
                        <img src="{{ Storage::url($v->foto) }}" alt="Foto Pengaduan" width="100">
                    @else
                        Tidak Ada Foto
                    @endif
                </td>
                <td>{{ $v->user->nama }}</td>
                <td>{{ $v->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($v->tgl_pengaduan)->format('d M, h:i') }}</td>
                <td>
                    @if ($v->status == '0')
                        <a href="" class="badge badge-danger text-white p-1">Pending</a>
                    @elseif ($v->status == 'proses')
                        <a href="" class="badge badge-warning text-white p-1">Proses</a>
                    @else
                        <a href="" class="badge badge-success text-white p-1">Selesai</a>
                    @endif
                </td>

                <td>
                    <a href="{{ route('pengaduan.show', ['pengaduan' => $v->id]) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                    <form action="{{ route('pengaduan.destroy', ['pengaduan' => $v->id]) }}" method="POST" style="display: inline-block">
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
