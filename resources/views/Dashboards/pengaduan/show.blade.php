@extends('layouts.master')

@section('title', 'Detail Pengaduan')

@section('css')
<style>
    .text-primary:hover {
        text-decoration: underline;
    }

    .text-grey {
        color: #6c757d;
    }

    .text-grey:hover {
        color: #6c757d;
    }

    .btn-purple {
        background: #6a70fc;
        border: 1px solid #6a70fc;
        color: #fff;
        width: 100%;
    }
</style>
@endsection

@section('sub-title')
<a href="{{ route('pengaduan.index') }}" class="text-primary">Data Pengaduan</a>
<a href="#" class="text-grey">/</a>
<a href="#" class="text-grey">Detail Pengaduan</a>
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

<div class="row justify-content-center">
    <div class="col-lg-11 col-12">
        <div class="card">
            <div class="card-header">
                <div class="text-center">Aduan Masyarakat</div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>NIK</th>
                            <td>:</td>
                            <td> {{ $pengaduan->nik }} </td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ $pengaduan->user->nama }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengaduan</th>
                            <td>:</td>
                            <td> {{ $pengaduan->tgl_pengaduan }} </td>
                        </tr>
                        <tr>
                            <th>Judul </th>
                            <td>:</td>
                            <td> {{ $pengaduan->judul }} </td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>:</td>
                            <td> <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto Pengaduan" class="embed-responsive" style="max-width: 100%; height: auto;"> </td>
                        </tr>
                        <tr>
                            <th>Isi Laporan</th>
                            <td>:</td>
                            <td> {{ $pengaduan->isi_laporan }} </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                                @if ($pengaduan->status == '0')
                                <span class="badge badge-danger">Pending</span>
                                @elseif ($pengaduan->status == 'proses')
                                <span class="badge badge-warning text-white">Proses</span>
                                @else
                                <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 <br>
<div class="row p-5 justify-content-center">
<div class="col-lg-10 col-12">
        <div class="card">
            <div class="card-header">
                <div class="text-center">Tanggapan Petugas</div>
            </div>
            <div class="card-body">
                <form action="{{ route('tanggapan.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="input-group mb-3">
                            <select name="status" id="status" class="custom-select">
                                <option value="0" {{ $pengaduan->status === '0' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $pengaduan->status === 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $pengaduan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggapan">Tanggapan</label>
                        <textarea name="tanggapan" id="tanggapan" class="form-control" rows="4" placeholder="Tambahkan tanggapan Anda di sini">{{ $tanggapan->tanggapan ?? ''}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Tanggapan</button>
                </form>
                <br>
                @if ($tanggapan)
                <form action="/tanggapan/{{$tanggapan->id}}"  method="POST">
                    @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus tanggapan ini?')">Hapus Tanggapan</button>
                    </form>
                @endif

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
